<?php

namespace App\DailyLearning;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay09_06_03 extends TestCase
{
    /**
     * Today's topic is fillable property.  
     * 
     * A fillable property of a model tells the model which property it should allow to fill in database. 
     * 
     * if a property is not marked as fillable. then the framework will throw MassAssignment Exception. It provides an extra layer of security to the database. 
     *  
     * but it can be turned off. 
     */
}

class User extends Model{
    public $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'username'
    ];

    protected $guarded = []; // setting this property to null or empty array. turns off the MassAssignment Exception.
}

