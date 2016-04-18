<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsLeadColumnToScouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scouters', function(Blueprint $table){
            $table->string('btc_no', 50)->nullable()->after('l_name');
            $table->date('btc_date')->nullable()->after('btc_no');
            $table->string('advance_no', 50)->nullable()->after('btc_date');
            $table->date('advance_date')->nullable()->after('advance_no');
            $table->string('alt_no', 50)->nullable()->after('advance_date');
            $table->date('alt_date')->nullable()->after('alt_no');
            $table->string('lt_no')->nullable()->after('alt_date');
            $table->date('lt_date')->nullable()->after('lt_no');

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
            $table->dropColumn('btc_no');
            $table->dropColumn('btc_date');
            $table->dropColumn('advance_no');
            $table->dropColumn('advance_date');
            $table->dropColumn('alt_no');
            $table->dropColumn('alt_date');
            $table->dropColumn('lt_no');
            $table->dropColumn('lt_date');
        });
    }
}
