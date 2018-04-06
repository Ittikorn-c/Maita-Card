<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string("reward_code");
            $table->unsignedInteger("card_id");
            $table->unsignedInteger("promotion_id");
            $table->unsignedInteger("employee_id");
            $table->timestamps();

            $table->foreign("card_id")
                    ->references("id")
                    ->on("cards");
            $table->foreign("promotion_id")
                    ->references("id")
                    ->on("promotions");
            $table->foreign("employee_id")
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
        Schema::table("reward_histories", function(Blueprint $table){
            $table->dropForeign(["card_id"]);
            $table->dropForeign(["promotion_id"]);
            $table->dropForeign(["employee_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reward_histories');
    }
}
