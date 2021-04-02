<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public $faker; 

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function email_id_should_be_unregistered_for_new_registration()
    {
        $user = User::factory()->create();
        $response = $this->post('/register', [
            'email' => $user->email,
            'name' => 'hello owrl',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertSessionDoesntHaveErrors(['password', 'name']);
        $response->assertSessionHasErrors(['email' => 'The email has already been taken.']);
    }

    /** @test */
    public function name_field_is_required()
    {
        $response = $this->post('/register', [
            'email' => $this->faker->unique()->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasErrors(['name' => 'The name field is required.'])->assertSessionDoesntHaveErrors(['email', 'password']);
        // $response->dumpSession();
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->from(route('register'))->post(route('register'), [
            'name' => 'hell o wor Ld',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasErrors(['email' => 'The email field is required.'])
            ->assertSessionDoesntHaveErrors(['name', 'password'])
            ;
        // $response->dumpHeaders();
        $response->assertRedirect('/register');
    }


}
