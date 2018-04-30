<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->unsignedInteger("owner_id");
            $table->string("phone");
            $table->string("email");
            $table->enum("category",[
                "restaurant",
                "cafe",
                "salon",
                "fitness",
                "mall",
                "cinema"
            ]);
            $table->string("logo_img");
            $table->timestamps();

            $table->foreign("owner_id")
                    ->references("id")
                    ->on("users")
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
        Schema::table("shops", function(Blueprint $table){
            $table->dropForeign(["owner_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('shops');
    }
}
