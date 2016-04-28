<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scouters', function( Blueprint $table){

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 50);
            $table->string('permission', 50)->nullable();
            $table->date('permission_date')->nullable();
            $table->string('btc_no', 50)->nullable();
            $table->date('btc_date')->nullable();
            $table->string('advance_no', 50)->nullable();
            $table->date('advance_date')->nullable();
            $table->string('alt_no', 50)->nullable();
            $table->date('alt_date')->nullable();
            $table->string('lt_no')->nullable();
            $table->date('lt_date')->nullable();
            $table->boolean('is_lead')->default(false);
            $table->integer('organization_id')->unsigned();
            $table->string('email');

            $table->foreign('organization_id')->references('id')->on('organizations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scouters');
    }
}
