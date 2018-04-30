<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("shop_id");
            $table->string("name");
            $table->string("location");
            $table->string("address");
            $table->text("description");
            $table->string("phone");
            $table->string("checkin_code");
            $table->timestamps();

            $table->foreign("shop_id")
                    ->references("id")
                    ->on("shops")
                    ->onDelete('cascade');
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
        Schema::table("branches", function(Blueprint $table){
            $table->dropForeign(["shop_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('branches');
    }
}
