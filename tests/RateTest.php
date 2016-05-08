<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_rate(){


        $this->visit('/rate')
            ->type(10 , 'registration_rate')
            ->type(20, 'scouter_rate')
            ->type(30, 'team_rate')
            ->type(40, 'committee_members_rate')
            ->type(50, 'disaster_mgmt_trust_rate')
            ->press('Submit')
            ->seeInDatabase('rates', [
                'registration_rate' => 10,
                'scouter_rate'      => 20,
                'team_rate'         => 30,
                'committee_members_rate'    => 40,
                'disaster_mgmt_trust_rate'  => 50
            ]);
    }
}
