<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLeadColumnToScoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scouters', function(Blueprint $table){
            $table->boolean('is_lead')->default(false)->after('lt_date');
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
            $table->dropColumn('is_lead');
        });
    }
}
