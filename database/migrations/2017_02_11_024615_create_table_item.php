<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function(Blueprint $table){
            $table->increments('id');
            $table->string('item_name');
            $table->integer('category_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->double('price');
            $table->double('onqty');
            $table->string('description');
            $table->double('real_price');
            $table->integer('highlight_id')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category');
            $table->foreign('unit_id')->references('id')->on('unit');
            $table->foreign('highlight_id')->references('id')->on('highlight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item');
    }
}
