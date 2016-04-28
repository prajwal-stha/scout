<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTeamMembersTable extends Migration
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
            $table->integer('original_id')->unique()->unsigned();
            $table->string('f_name', 50)->index();
            $table->string('m_name', 50)->index();
            $table->string('l_name', 50)->index();
            $table->date('dob');
            $table->date('entry_date');
            $table->string('position', 50);
            $table->date('passed_date');
            $table->text('note');
            $table->integer('team_id')->unsigned();
            $table->timestamps();

            $table->foreign('team_id')->references('original_id')->on('core_teams');

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
