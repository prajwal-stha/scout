<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToCoreTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_teams', function(Blueprint $table){
            $table->enum('gender', ['Male', 'Female', 'Other'])->after('name');
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
        Schema::table('core_teams', function(Blueprint $table){
            $table->dropColumn('gender');
            $table->dropColumn('type');

        });
    }
}
