<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay05_28_02 extends TestCase
{
    /*
        Objective: This code shows how to get network details of a people.
        This function should be defined in User model of laravel ( or whatever your authentication model is called)

        defined in app/Models/User.php file. 
    **/
    public function get_immediate_network()
    {
        return $this->hasMany(User::class, 'parent_id')
    }

    /**
        function to get parent user of a user. 
    */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
        Get All Users of Network.
    */
    public function getNetwork()
    {
        $children = $this->getImmediateNetwork;
       
        if ($children->count() == 0) return $children;

        foreach ($children as $child) {
            $children = $children->merge($child->getNetwork());
        }

        return $children;
    }




    

}

