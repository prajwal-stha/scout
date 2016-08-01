<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMNameToCoreOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_organizations', function(Blueprint $table){
            $table->string('chairman_m_name', 50)->index()->after('chairman_f_name');
            $table->enum('chairman_gender', ['Male', 'Female', 'Other'])->after('chairman_mobile_no');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_organizations', function(Blueprint $table){
            $table->dropColumn('chairman_m_name');
            $table->dropColumn('chairman_gender');

        });
    }
}
