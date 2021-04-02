<?php

namespace App\DailyLearning;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LearningDay03_25_02 extends TestCase
{
    /**
     * @test  
     *  THIS TEST SHOWS HOW YOU CAN VERIFY AN EXCEPTION BEING THROWN 
     *  But this method won't run anything after last exception related assertion. 
     * @method 1. 
     * @throws AuthenticationException ( lets' assume )
     */
    public function if_you_only_want_to_test_that_an_exception_is_thrown()
    {
        $user = User::factory()->make();

        $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->expectException(AuthenticationException::class);

        $this->expectExceptionMessage('foo bar'); // checking authentication message. 

        $this->expectExceptionCode(403); // checking code. 

        $this->assertDatabaseCount('users', 0); // this won't be checked
    }


    /** @test 
     * the method above won't test anything after code is checked. 
     * so if you have any other things. then use the following methods. 
     * @method 2
     */
    public function if_you_want_to_some_more_things_after_exception_is_verified()
    {
        $user = User::factory()->make();
        try { // this is the part where you specify which part you want to test. 
            $response =  $this->from('/login')->post('/login', [
                'email' => $user->email,
                'password' => 'password'
            ]);
        } catch (\Throwable $th) { // here you catches any occuring exceptions. 
            $this->assertInstanceOf(AuthenticationException::class, $th);

            $this->assertStringContainsString('unauthenticated', $th->getMessage());

            // if you want to ignore cases while checking. 
            $this->assertStringContainsStringIgnoringCase('unauthenticated', $th->getMessage());

            // if you want to assert some more specify here. 
            $this->assertDatabaseCount('users', 0);
            $response->assertStatus(401);
        }
    }
}
/**
 * @part 2: 
 *  define various types of factory states : It is for defining various types of model instances with different
 *  properties. 
 * 
 *  I assume that I have made a factory named ProductFactory class, and i want to have three different types of 
 *  objects based on color: 1. red, 2. blue,
 * 
 *  then in Userfactory::class, after definition function add your states. like. 
 */
class ProductFactory extends Factory 
{
    public function definition()
    {
        return [
            'name' => 'apple'
        ];
    }   

    /**
     * define your various states here. 
     */
    public function red()
    {
        return $this->state(function(array $a){
            return [
                'color' => 'red',
            ];
        });
    }

    public function blue();
    {
        # code...
        return $this->state(function(array $a){
            return [
                'color' => 'blue';
            ];
         });
    }
    
}

/**
 * if you want to use states to an red product. then you can use: 
 */

 function method_showing_state_use()
 {
     $product1 = Product::factory()->red()->create(); // to create a red product. 
     $product2 = Product::factory()->blue()->create(); // to create a blue product. 
 }
