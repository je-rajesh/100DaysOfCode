<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay05_28_02 extends TestCase
{
	    /**
        Returning multiple values from function in PHP. 
    */
    public function this_function_returns_multiple_values()
    {
        return [3, 4, 5, 6];
        
    }

    /**
        This function accepts multiple returned values. 
    */
    public function this_function_accepts_multiple_values()
    {
        list($a, $b, $c, $d) = $this->this_function_accepts_multiple_values();
    }
    
    
    /**
     * How to pass a variable by reference to a function. 
     */

    public function this_function_accepts_input_as_reference(Object & $obj)
    {
        $obj->message = 'foo';
        // do your stuffs. 

        // no need to return. but for a better design return it. 
        return $obj;
    }


    /**
     * This function demonstrate this concept. 
     */
    public function this_function_uses_this_concept()
    {
        $obj = (Object)[] ;

        $obj->message = 'bar';

        $n = $this->this_function_accepts_input_as_reference($obj);

        dump($n->message); // prints 'foo';
    }

    
}

