<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_teams', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 50);
            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('core_organizations');
            $table->unique(['name', 'organization_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_teams');
    }
}
