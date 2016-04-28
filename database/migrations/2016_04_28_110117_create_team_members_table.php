<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('f_name', 50)->index();
            $table->string('m_name', 50);
            $table->string('l_name', 50)->index();
            $table->date('dob');
            $table->date('entry_date');
            $table->string('position', 50);
            $table->date('passed_date');
            $table->text('note');
            $table->integer('team_id')->unsigned();

            $table->foreign('team_id')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_members');
    }
}
