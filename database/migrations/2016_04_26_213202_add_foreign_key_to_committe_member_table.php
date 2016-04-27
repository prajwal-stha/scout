<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCommitteMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table){

//            $table->dropForeign(['organization_id']);
            $table->integer('original_id')->unique()->after('id')->unsigned();
//            $table->foreign('organization_id')->references('original_id')->on('core_organizations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table){

//            $table->dropForeign(['organization_id']);
//            $table->foreign('organization_id')->references('id')->on('core_organizations');

        });
    }
}
