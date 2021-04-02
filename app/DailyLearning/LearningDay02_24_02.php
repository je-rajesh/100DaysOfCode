<?php

namespace App\DailyLearning;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LearningDay02_24_02 extends TestCase
{
    /** @test
     * 
     * This test shows how to check constraint on database level. 
     * if a exception occurs then it will be thrown. 
     * At database level when CRUD operation is done. then QueryException is thrown. 
     */
    public function username_is_required()
    {
        $this->withoutexceptionhandling();
        $this->ExpectExceptionMessage('NOT NULL constraint failed');
        $this->expectexception(QueryException::class);
        $user = User::factory()->create(['username' => null]);
        $this->assertdatabasecount('users', 0);
    }

    /** @test 
     * This test shows how to check if a table exists in database or not. 
     */
    public function asserting_that_a_table_exists(): void
    {
        $this->assertTrue(Schema::hasTable('users')); // asserting that the users table exist. 

        $this->assertFalse(Schema::hasTable('admins')); // asserting that admins table doesn't exist
    }

    /** @test
     * 
     * This test shows how to check if something is not required or can be null at database level 
     */
    public function parent_is_not_required()
    {
        // $this->expectexceptionmessage('not null');
        // $this->expectexception(queryexception::class);
        // $this->assertdatabasecount('users', 0);
        // user::unguard();

        $user = user::factory()->create(['parent_id' => null]);
        // dd($user);
        $this->assertdatabasecount('users', 1);
        $this->assertdatabasehas('users', $user->getattributes());
    }

    /** @test
     * 
     * This test shows how to check if something not value is provided then it would be accepted. 
     *  and it persists in database. 
     */
    public function parent_id_is_set_when_it_is_provided_when_being_passed()
    {
        $user1 = user::factory()->create();

        $user2 = user::factory()->create([
            'parent_id' => $user1->id,
        ]);

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseHas('users', ['id' => $user2->id, 'parent_id' => $user1->id]);
    }
}
