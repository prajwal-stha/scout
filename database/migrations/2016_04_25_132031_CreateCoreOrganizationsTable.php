<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_organizations', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('registration_no')->unique();
            $table->integer('district_id')->unsigned();
            $table->date('registration_date')->nullable();
            $table->string('renew_status')->nullable();
            $table->enum('type', ['school', 'other']);
            $table->string('name', 100)->index();
            $table->string('chairman_f_name', 50)->index();
            $table->string('chairman_l_name', 50)->index();
            $table->string('chairman_mobile_no', 50);
            $table->string('tel_no', 50);
            $table->string('address_line_1', 50);
            $table->string('address_line_2', 50);
            $table->string('email', 50);
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('background_colour');
            $table->string('border_colour');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_organizations');
    }
}
