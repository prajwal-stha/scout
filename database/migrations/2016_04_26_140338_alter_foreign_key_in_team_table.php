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

            $table->dropColumn('original_id');

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

            $table->integer('original_id')->unique()->unsigned()->after('id');

        });
    }
}
