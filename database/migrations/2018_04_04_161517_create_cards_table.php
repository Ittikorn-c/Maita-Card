<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("template_id");
            $table->integer("point");
            $table->integer("checkin_point");
            $table->dateTime("exp_date");
            $table->timestamps();

            $table->foreign("user_id")
                    ->references("id")
                    ->on("users");
            $table->foreign("template_id")
                    ->references("id")
                    ->on("card_templates");
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
        Schema::table("cards", function(Blueprint $table){
            $table->dropForeign(["user_id"]);
            $table->dropForeign(["template_id"]);
        });
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('cards');
    }
}
