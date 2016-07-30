<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function(Blueprint $table){
            $table->enum('gender', ['male', 'female', 'other'])->after('name');
            $table->enum('type', ['Six', 'Patrol', 'Venture Capital', 'Crew'])->after('gender');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function(Blueprint $table){
            $table->dropColumn('gender');
            $table->dropColumn('type');

        });
    }
}
