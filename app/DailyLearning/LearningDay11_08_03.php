<?php

namespace App\DailyLearning;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay11_08_03 extends TestCase
{
    /** 
     *  This tutorials is about different validation methods available in laravel while submitting form requests. 
     * 
     */
    public function validate_form(Request $request)
    {
        $request->validate([
            'name' => 'string|min:3|max:10',
            'email' => 'string|email|regex:/(.+){1,}@(.+){1,}\.(.+){3,}/g',
            'age' => 'date_format:Y-m-d',
            'pin' => 'digit:4',
            'file' => 'file|image|dimesions:min_width=100,min_height=200',
            'roll_no' => 'required',
            'username' => 'required|unique:users,username',
            'parent_name' => 'nullable'
        ]);

        /**
         * string checks if a field is string or not. 
         * min: checks if a string or number has specified min length or not. 
         * max: checks if a string or number has specified max lenght or not
         * date_format : checks if date entered in form is in correct format or not 
         * emai: checks for a valid email address. 
         * regex: checks if a string is valid specified regex expression or not. 
         * file: checks if the field is a valid file uploaded or not. 
         * image: checks for uploaded file extensions for valid image file. 
         * required : forces the user to enter the field. 
         * nullable: field can be empty 
         * digit: checks for the numeric string with specified lenght. 
         * 
         */
    }
}
