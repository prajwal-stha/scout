<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOriginalIdToCoreOrganizationCommitteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table) {
            $table->integer('original_id')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_organization_commitee_members', function(Blueprint $table) {
            $table->dropColumn('original_id');
        });
    }
}
