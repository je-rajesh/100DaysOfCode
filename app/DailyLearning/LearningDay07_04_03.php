<?php

namespace App\DailyLearning;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Schema;

class LearningDay07_04_03
{
   /**
    * Today i learned how to make factories in laravel with polymorphic relationship
     */ 
}

/**
 * For setup we are defining. Three models: User, Address and Store. 
 * 
 * relationship is like it. 
 *      A user can have many addresses 
 *      A store can have only one address. 
 */

 class User extends AuthUser 
 {
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }  
 }

 class Address extends Model
 {
    public function addressable()
    {
        return $this->morphTo();
    }   
 }

class Store extends Model
{
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }   
}

/**
 * This is basic database setup here. 
 * 
 * You can add another fields here too. like name is extra field. 
 */
class CreateAddressTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table){
            $table->string('full_address');
            $table->string('addressable_type');
            $table->unsignedBigInteger('addressable_id');
        });
    }
}


/**
 * Now to use in factories.
 */
class AnyFactory extends Factory
{
    public function definition()
    {
        return [
            'full_address' => $this->faker->address,
        ];
    }
}

/**
 * create addresses. 
 */

function create_addresses()
{
    $user = User::factory()->create();
    
    $address = Address::factory()->for($user); // creating for already defined user. 

    $address2 = Address::factory()->for(User::factory())->create(); // creating for a new user. 
    // first user will be created then address will be created. 
    $addresses2 = Address::factory()->count(4)->for(User::factory())->create(); // for creating collection. 


}


 
 
