<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("branch_id");
            $table->timestamps();

            $table->foreign("user_id")
                    ->references("id")
                    ->on("users")
                    ->onDelete('cascade');
            $table->foreign("branch_id")
                    ->references("id")
                    ->on("branches")
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
        Schema::table("employees", function(Blueprint $table){
            $table->dropForeign(["user_id"]);
            $table->dropForeign(["branch_id"]);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('employees');
    }
}
