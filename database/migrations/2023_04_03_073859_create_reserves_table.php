<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')->unsigned();
            $table->unsignedInteger('table_id');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');            
            $table->tinyInteger('diner_number');
            $table->date('date');
            $table->time('hour');
            $table->text('observations', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}
