<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTeamMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_team_members', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('f_name', 50)->index();
            $table->string('l_name', 50)->index();
            $table->date('dob');
            $table->date('entry_date');
            $table->string('position', 50);
            $table->date('passed_date');
            $table->text('note');
            $table->integer('team_id')->unsigned();

            $table->foreign('team_id')->references('id')->on('core_teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_team_members');
    }
}
