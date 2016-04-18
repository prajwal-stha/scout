<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMNameToOrganizationCommiteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organization_commitee_members', function(Blueprint $table){
            $table->string('m_name', 50)->after('f_name')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_commitee_members', function(Blueprint $table){
            $table->dropColumn('m_name');
        });
    }
}
