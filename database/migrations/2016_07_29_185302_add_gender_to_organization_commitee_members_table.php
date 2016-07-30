<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderToOrganizationCommiteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organization_commitee_members', function(Blueprint $table){
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
        Schema::table('organization_commitee_members', function(Blueprint $table){
            $table->dropColumn('gender');

        });
    }
}
