<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTableItem2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item', function(Blueprint $table){
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
        //
    }
}
