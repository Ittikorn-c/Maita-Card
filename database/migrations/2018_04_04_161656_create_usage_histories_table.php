<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("card_id");
            $table->integer("point");
            $table->unsignedInteger("employee_id");
            $table->timestamps();

            $table->foreign("card_id")
                    ->references("id")
                    ->on("cards")
                    ->onDelete('cascade');
            $table->foreign("employee_id")
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
        Schema::table("usage_histories", function(Blueprint $table){
            $table->dropForeign(["card_id"]);
            $table->dropForeign(["employee_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('usage_histories');
    }
}
