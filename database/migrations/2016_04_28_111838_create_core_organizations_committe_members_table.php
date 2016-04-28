<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreOrganizationsCommitteMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_organization_commitee_members', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('original_id')->unique()->unsigned();
            $table->string('f_name', 50)->index();
            $table->string('m_name', 50)->index();
            $table->string('l_name', 50)->index();
            $table->integer('organization_id')->unsigned();
            $table->timestamps();

            $table->foreign('organization_id')->references('original_id')->on('core_organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_organization_commitee_members');
    }
}
