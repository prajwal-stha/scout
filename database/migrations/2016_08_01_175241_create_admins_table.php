<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->string('level')->default(1);
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropifExists('admins');
    }
}
