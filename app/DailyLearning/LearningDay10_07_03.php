<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay10_07_03 extends TestCase
{
    /**
     *  today i had to work with laravel 5.7
     */
    public function migrating_laravel_5_7_factories_to_laravel8()
    {
        $user1 = factory(App\Models\User::clas)->create(); // for laravel 5.7

        $user2 = App\Models\User::factory()->create(); //  for laravel 8. 


        // you can't define polymorphic factories relation from factories like it is done in laravel 8. 
        // instead you can use factories state in laravel 5.7
        // in UserFactory.php define like. 
        /** @var Illuminate\Eloquent\Database\Factory $factory*/
        $factory->state(App\Models\User::class, 'customer', [
            'user_type' => 'customer',
        ]);
    }

    
}
