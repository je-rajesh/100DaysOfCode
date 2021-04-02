<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Tests\TestCase;

class LearningDay12_09_03 extends TestCase
{
    /** make a valid blade component in laravel */
}

/**
 * run artisan command: `php artisan make:component Alert`.
 *  
 * it will create resources/Components/Alert.php. 
 * 
 */

class Alert extends Component
{
    /**
     * public fields specified here will be accessible in the view template. 
     * 
     * but not private and protected fields. 
     */
    public $name;

    public $roll_no;

    public function __construct(string $name, int $roll_no)
    {
        $this->name = $name;

        $this->roll_no = $roll_no;
    }

    /**
     * Render method is where we render our view component from.
     *  
     */
    public function render()
    {
        return view('components.alert');
    }
}

/**
 * now we can use this components in any view files like 
 * <x-alert :name="$user->name" :roll_no="$user->roll_no" ></x-alert>
 */
