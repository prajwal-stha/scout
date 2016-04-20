<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionColumnToScouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scouters', function(Blueprint $table){
            $table->string('permission', 50)->nullable()->after('lt_date');
            $table->date('permission_date')->nullable()->after('permission');
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
            $table->dropColumn('permission');
            $table->dropColumn('permission_date');
        });
    }
}
