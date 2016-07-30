<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderToCoreOrganizationCommiteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table){
            $table->enum('gender', ['Male', 'Female', 'Other'])->after('l_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table){
            $table->dropColumn('gender');

        });
    }
}
