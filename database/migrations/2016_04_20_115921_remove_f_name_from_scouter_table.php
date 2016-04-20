<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFNameFromScouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scouters', function(Blueprint $table){
            $table->dropColumn('f_name');
            $table->dropColumn('l_name');
            $table->string('name', 50)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scouters', function(Blueprint $table){
            $table->dropColumn('name');
        });
    }
}
