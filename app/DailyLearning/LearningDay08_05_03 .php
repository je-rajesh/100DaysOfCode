<?php

namespace App\DailyLearning;

use Database\Factories\UserModelFactory;
use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\Factory as FactoriesFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class LearningDay08_05_03 extends TestCase
{
    /**
     * by default The User model will look for UserFactory in database/factories folder. 
     * But it can be customised : 
     *
     */
}
/**
 * define a static function newFactory in the model class. 
 */
class User extends Model
{
    public function newFactory()
    {
        return UserModelFactory::new();
    }
}

/**
 * now in the factory class, proceed as it is.
 */
class UserModelFactory extends FactoriesFactory
{
    protected $model = User::class; 

    public function definition()
    {
        return [
            'name' => 'hello world',
        ];
    }
}

