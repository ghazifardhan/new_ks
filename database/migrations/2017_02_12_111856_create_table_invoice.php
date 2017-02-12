<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function(Blueprint $table){
            $table->increments('id');
            $table->string('invoice_code');
            $table->date('invoice_date');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address_1');
            $table->string('customer_address_2');
            $table->string('customer_address_3');
            $table->string('payment_method');
            $table->date('shipping_date');
            $table->double('voucher');
            $table->string('description');
            $table->string('description_2');
            $table->boolean('is_paid');
            $table->double('total');
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
        Schema::drop('invoice');
    }
}
