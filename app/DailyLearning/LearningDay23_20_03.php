<?php

namespace Tests\Feature;

use App\Models\createapp;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LearningDay23_20_03 extends TestCase
{
    /** @test */
    use DatabaseMigrations;


    public function user_can_access_multiform_page()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $profile = $user->profile;

        $p = Profile::factory()->make();

        $profile->update($p->toArray());

        $response = $this->actingAs($user)->get('/multiform');


        $this->assertNotNull($user->profile->developername);
        $response->assertSee($user->profile->developername);
        // dd($user->profile->developername);

        $response->assertSuccessful();
    }


    /** @test */
    public function fields_has_validation_while_creating_application()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $data = $this->get_form_data();

        $response = $this->actingAs($user)
            ->from('/multiform')
            ->post('/multiform', $data)
            ->assertRedirect('/playlist');
    }

    /** @test */
    public function asserts_that_image_has_proper_size_and_dimensions()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        Storage::fake('public');
        // shell_exec("rm -r public/storage/icon_image");
        shell_exec("rm -r grablorweb/public/storage/icon_image");

        $directory = getcwd() . '/grablorweb/public/storage/icon_image';


        $icon = UploadedFile::fake()->image('icon2.jpg', 130, 150)->size(500);

        $data = $this->get_form_data(['icon' => $icon]);

        $response = $this->actingAs($user)
            ->from('/multiform')
            ->post('/multiform', $data)
            ->assertRedirect('/playlist');


        $files = glob($directory . "*");
        $this->assertEquals(1, count($files));

        $this->assertCount(1, createapp::all());
    }


    /** @test */
    public function colors_are_provides()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        Storage::fake('public');
        // shell_exec("rm -r public/storage/icon_image");
        shell_exec("rm -r grablorweb/public/storage/icon_image");

        $directory = getcwd() . '/grablorweb/public/storage/icon_image';


        $icon = UploadedFile::fake()->image('icon2.jpg', 130, 150)->size(500);

        $data = $this->get_form_data(['color' => '#908123']);

        $response = $this->actingAs($user)
            ->from('/multiform')
            ->post('/multiform', $data)
            ->assertRedirect('/playlist');


        $files = glob($directory . "*");
        $this->assertEquals(1, count($files));

        $this->assertCount(1, createapp::all());
    }

    public function get_form_data($array = [])
    {
        $data = [
            'appname' => 'appgallery',
            'icon' => UploadedFile::fake()->image('icon.jpg', 512, 512)->size(100),
            'color' => '#43a107',
            'apikey' => '234234323sdfjkla',
            'supportmail' => 'support@user.net',
            'redirecturl' => 'redirect@user.net',
            'privacypolicy' => 'hello@user.net',
            'subdomainurl' => 'hello@user.net',
            'user_id' => 1, // needs to be override, 
            'version_no' => 1,
            'packagename' => 'apple',
            'facebook' => 1,
            'admob' => 0,
            'fbpappid' => 'facebook332-23',
            'fbbannerid' => '4343',
            'fbinterid' => 'ada23',
            'adappid' => 'ad123123',
            'adbannerid' => 'ad123123',
            'adinterid' => '234jkfdj',
        ];
        return  array_merge($data, $array);
    }
}

