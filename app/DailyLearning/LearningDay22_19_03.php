<?php

namespace Tests\Unit;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;

class LearningDay22_19_03 extends TestCase
{
    // use DatabaseMigrations;


    /** @test */
    public function can_get_formatted_date()
    {
        $this->withoutExceptionHandling();
        // act: 
        //      create a concert with a known date 
        $concert = Concert::factory()->make([
            'date' => Carbon::parse('2019-12-01 8:00pm')
        ]);
        // assert: 
        // verify the formatted date.
        $this->assertEquals('December 1, 2019', $concert->formatted_date);
    }


    /** @test */
    public function can_get_formatted_time()  
    {
        $this->withoutExceptionHandling();

        $concert = Concert::factory()->make([
            'date' => Carbon::parse('2019-12-01 18:00:00')
        ]);

        $this->assertEquals('6:00pm', $concert->formatted_start_time);
    }

    /** @test */
    public function can_get_ticket_price_in_dollars()  
    {
        $this->withoutExceptionHandling();

        $concert = Concert::factory()->make([
            'ticket_price' => 9320
        ]);

        $this->assertEquals('93.20', $concert->ticket_price_in_dollars);
    }
}
