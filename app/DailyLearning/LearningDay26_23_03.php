<?php

namespace Tests\Feature;

class LearningDay27_24_03
{
    /**
     * Today i designed login and registration page in quasar js. 
     */
      /** @test */
    public function asserts_that_image_has_proper_size_and_dimensions()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        // Storage::fake('icon');
        // shell_exec("rm -r public/storage/icon_image");
        // shell_exec("cd grablorweb/public/storage/icon_image/ && rm -r *");
        $directory = storage_path('/app/public/icon_image');
        $files = glob($directory . "/*");
        foreach ($files as $f) {
            unlink($f);
            // dump($f);
        }

        $icon = UploadedFile::fake()->image('icon2.jpg', 130, 150)->size(500);

        $data = $this->get_form_data(['icon' => $icon]);

        $uploaded_file_name = 'icon2_' . time() . '.' . $icon->getClientOriginalExtension();

        $response = $this->actingAs($user)
            ->from('/multiform')
            ->post('/multiform', $data)
            ->assertRedirect('/playlist');


        // Storage::disk('icon')->assertExists($uploaded_file_name);
        dump(createapp::first());

        $files = glob($directory . "/*");
        dump(count($files));
        $this->assertEquals(1, count($files));

        $this->assertCount(1, createapp::all());
    }


    
}
