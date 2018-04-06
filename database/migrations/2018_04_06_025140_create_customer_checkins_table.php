<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_checkins', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->string("checkin_code");
            $table->timestamps();

            $table->foreign("user_id")
                    ->references("id")
                    ->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::table("customer_checkins", function(Blueprint $table){
            $table->dropForeign(["user_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_checkins');
    }
}
