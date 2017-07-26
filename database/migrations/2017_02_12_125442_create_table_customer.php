<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function(Blueprint $table){
            $table->increments('id');
            $table->string('customer_name');
            $table->integer('customer_type')->unsigned();
            $table->string('description');
            $table->timestamps();

            //$table->foreign('customer_type')->references('id')->on('customer_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer');
    }
}
