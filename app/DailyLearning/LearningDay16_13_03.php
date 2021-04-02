<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay16_13_03 extends TestCase
{
    /**
     *  Today i learnt how to do mobile api testing using laravel with sanctum package.  
     */
    
    /** @test */
    public function test_new_users_can_register()
    {

        $response = $this->postJson('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // $this->assertAuthenticated();
        // $user = auth()->user();
        // $this->assertEquals($user->email, 'test@example.com');
        $response->assertJson([
            'message' => 'USER SUCCESSFULLY REGISTERED! an email has been sent to you',
            'status' => 200,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'token'
            ]
        ]);

        dump('token response', $response['data']['token']);

        $this->withToken($response['data']['token'])->getJson('/test-route')->assertJson([
            'rajesh' => 'kumar'
        ])->assertSuccessful();
    }


    /** @test */
    public function user_gets_invalid_data_response_if_passed_wrong_data()
    {
        $response =  $this->postJson('/register', [
            'name' => null,
            'email' => 'test@example.com',
            'password' => 'homework',
            'password_confirmation' => 'homework'
        ]);

        $response->assertJson([
            'errors' => [
                'name' => ['The name field is required.']
            ]
        ]);
        $response =  $this->postJson('/register', [
            'name' => 'alex',
            'email' => null,
            'password' => 'homework',
            'password_confirmation' => 'homework'
        ]);

        $response->assertJson([
            'errors' => [
                'email' => ['The email field is required.']
            ]
        ]);
    }

    /** @test */
    public function password_mismatch_error_is_thrown()
    {
        $response =  $this->postJson('/register', [
            'name' => 'alex',
            'email' => 'test@examle.com',
            'password' => 'homework',
            'password_confirmation' => 'homework2'
        ]);

        // $response->dump();
        $response->assertJson([
            'errors' => [
                'password' => ['The password confirmation does not match.']
            ]
        ]);
    }
}
