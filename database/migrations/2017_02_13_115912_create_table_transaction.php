<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function(Blueprint $table){
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->double('item_qty');
            $table->double('discount');
            $table->double('deduction');
            $table->double('item_price');
            $table->string('description');
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->foreign('item_id')->references('id')->on('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
