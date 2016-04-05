<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_commitee_members', function(Blueprint $table){

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('f_name', 50);
            $table->string('l_name', 50);
            $table->integer('organization_id')->unsigned();

            $table->foreign('organization_id')->references('id')->on('organizations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_commitee_members');
    }
}
