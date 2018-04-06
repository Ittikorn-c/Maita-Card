<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("shop_id");
            $table->string("name");
            $table->string("img");
            $table->enum("style",[
                "stamp",
                "point"
            ]);
            $table->timestamps();

            $table->foreign("shop_id")
                    ->references("id")
                    ->on("shops");
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
        Schema::table("card_templates", function(Blueprint $table){
            $table->dropForeign(["shop_id"]);
        });
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('card_templates');
    }
}
