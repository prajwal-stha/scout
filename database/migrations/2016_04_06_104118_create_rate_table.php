<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();

            $table->mediumInteger('registration_rate')->unsigned();
            $table->mediumInteger('scouter_rate')->unsigned();
            $table->mediumInteger('team_rate')->unsigned();
            $table->mediumInteger('committee_members_rate')->unsigned();
            $table->mediumInteger('disaster_mgmt_trust_rate')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
}
