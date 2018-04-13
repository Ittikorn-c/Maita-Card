<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("template_id");
            $table->integer("point");
            $table->string("reward_name");
            $table->string("reward_img");
            $table->text("condition");
            $table->dateTime("exp_date");
            $table->timestamps();

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
        Schema::table("promotions", function(Blueprint $table){
            $table->dropForeign(["template_id"]);
        });
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('promotions');
    }
}
