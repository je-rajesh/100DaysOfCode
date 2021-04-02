<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay04_26_02 extends TestCase
{
   /**
    *  Today i am sharing how you can use seeders in database to populate the database while testing. 
        in testing class. in parent::setUp method just define this function. 
    */ 

    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(); // this method seeds your testing database before running tests. 
    }

    /** @test */
    public function validate_your_string_length_while_posting()   :void
    {
        $this->post('/books/create', [
            'name' => $this->faker->sentence(), // or use str_repeat('a', 50);0
        ]);
    }

    // while in BooksController.php you can validate like. 
    public function validating_name_string(Request $request)
    {
        $request->validate([
            'name' => 'size:50', // this will check if name is really equal to 50 or not. 
        ]);

        // for validating min length: use 
        $request->validate([
            'name' => 'min:50',
        ]);

        // validating max length, use 
        $request->validate([
            'name' => 'max:50',
        ]);

        // for length between two limits. notice here that the name will be accepted only if name length is greater than or equal to 10 and less than or equal to 50.
        $request->validate([
            'name' => 'between:10,50'
        ]);
    }


}



