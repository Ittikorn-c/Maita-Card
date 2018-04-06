<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string("fname");
            $table->string("lname");
            $table->string('email')->unique();
            $table->text("address");
            $table->string("phone");
            $table->datetime("birth_date");
            $table->enum("gender", [
                "male","female"
            ]);
            $table->string("profile_img");
            $table->enum("role", [
                "customer",
                "employee",
                "owner"
            ]);
            $table->enum("status", [
                "active",
                "inactive"
            ]);
            $table->string("facebook");
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
        Schema::dropIfExists('users');
    }
}
