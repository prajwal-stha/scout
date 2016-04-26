<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterForeignKeyInTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_teams', function(Blueprint $table){

            $table->dropForeign(['organization_id']);

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
        Schema::table('core_teams', function(Blueprint $table){

            $table->dropForeign(['organization_id']);
            $table->foreign('organization_id')->references('id')->on('core_organizations');

        });
    }
}
