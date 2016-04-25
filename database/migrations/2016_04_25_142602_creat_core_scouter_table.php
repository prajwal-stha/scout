<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatCoreScouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_scouters', function( Blueprint $table){

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 50);
            $table->string('btc_no', 50)->nullable();
            $table->date('btc_date')->nullable();
            $table->string('advance_no', 50)->nullable();
            $table->date('advance_date')->nullable();
            $table->string('alt_no', 50)->nullable();
            $table->date('alt_date')->nullable();
            $table->string('lt_no')->nullable();
            $table->date('lt_date')->nullable();
            $table->string('permission', 50)->nullable();
            $table->date('permission_date')->nullable();
            $table->boolean('is_lead')->default(false);
            $table->string('email');
            $table->integer('organization_id')->unsigned();
            $table->timestamps();
            $table->foreign('organization_id')->references('id')->on('core_organizations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_scouters');
    }
}
