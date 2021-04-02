<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use ArrayObject;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class LearningDay24_21_03 extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    public function a_user_receives_an_email_after_successfull_registration()
    {
        $this->withoutExceptionHandling();
        Notification::fake();

        $response = $this->from('/register')->post('/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/profile');

        Notification::assertSentTo([auth()->user()], VerifyEmail::class);
    }


    /** @test */
    public function a_user_should_not_access_any_part_of_application_without_verifying()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create(['email_verified_at' => null]);

        $this->actingAs($user)->get('/profile')->assertRedirect(route('verification.notice'));
    }


    /** @test */
    public function it_tests_that_all_fields_in_profile_form_is_compulsory()
    {
        // $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $data = [
            'fullname' => 'rajesh',
            'username' => 'rajesh343',
            'developername' => 'rajesh4343',
            'address' => '17B baker street london',
            'city' => 'london',
            'zip' => '334349',
            'state' => 'uk'
        ];
        $this->actingAs($user)->get('/profile')->assertSuccessful();

        // username checking
        $b1 = (new ArrayObject($data))->getArrayCopy();
        $b1['username'] = 'rajesh.rxca';

        $this->actingAs($user)
            ->from('/profile')->post('/profile', $b1)
            ->assertSessionHasErrors(['username']);

        // chcking for developer's name
        $b1 = (new ArrayObject($data))->getArrayCopy();
        $b1['developername'] = 'rajesh.rxca';

        $this->actingAs($user)
            ->from('/profile')->post('/profile', $b1)
            ->assertSessionHasErrors(['developername']);

        // address checking. 
        $b1 = (new ArrayObject($data))->getArrayCopy();
        $b1['address'] = '';

        // $this->withoutExceptionHandling();
        $this->actingAs($user)
            ->from('/profile')->post('/profile', $b1)
            ->assertSessionHasErrors(['address' => 'The address field is required.']);



        // address checking. 
        $b1 = (new ArrayObject($data))->getArrayCopy();
        $b1['city'] = '';
        $b1['state'] = '';
        $b1['zip'] = '';
        // $this->withoutExceptionHandling();
        $this->actingAs($user)
            ->from('/profile')->post('/profile', $b1)
            ->assertSessionHasErrors([
                'city' => 'The city field is required.',
                'state' => 'The state field is required.',
                'zip' => 'The zip field is required.',
            ]);


        // address checking. 
        $b1 = (new ArrayObject($data))->getArrayCopy();

        $b1['zip'] = 'fas';
        // $this->withoutExceptionHandling();
        $this->actingAs($user)
            ->from('/profile')->post('/profile', $b1)
            ->assertSessionHasErrors([
                'zip' => 'The zip must be a number.'
            ]);

        // $data['fullname'] = '';
    }


    /** @test */
    public function a_profile_can_be_created_using_valid_data()
    {

        $user = User::factory()->create();

        $data = [
            'fullname' => 'rajesh',
            'username' => 'rajesh343',
            'developername' => 'rajesh4343',
            'address' => '17B baker street london',
            'city' => 'london',
            'zip' => '334349',
            'state' => 'uk'
        ];


        // $this->withoutExceptionHandling();
        $this->actingAs($user)
            ->from('/profile')->post('/profile', $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect('/index');
    }

    /** @test */
    public function users_cant_access_create_application_page_unless_he_completes_profile()  
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/index')
            ->assertRedirect('/profile');
    }


    /** @test */
    public function user_is_redirected_to_login_page() 
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $data = ['email' => $user->email, 'password' => 'password'];

        $this->from('/login')->post('/login', $data)->assertRedirect('/index');

        $this->actingAs($user)->get('/index')->assertRedirect('/profile');

        $profile = Profile::factory()->make();

        $user->profile->update($profile->toArray());

        // $p = $user->profile->refresh();
        // dump($p->refresh());

        $this->actingAs($user)->get('/index')->assertSuccessful();
    }
}
