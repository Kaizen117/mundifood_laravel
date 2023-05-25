<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->engine = "InnoDB";
            //$table->increments('id')->unsigned();
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedInteger('table_number')->unique();
            $table->tinyInteger('diner_number')->unsigned();
            $table->string('place', 15);
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
