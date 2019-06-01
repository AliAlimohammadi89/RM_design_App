<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relationconvertor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Relationconvertor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shopify__converters_id')->unsigned();
          //  $table->foreign('shopify__converters_id')->references('id')->on('shopify__converters')->onDelete('cascade');
            $table->integer('shopify__converters_parent_id')->unsigned();
           // $table->foreign('shopify__converters_id_parent')->references('id')->on('shopify__converters')->onDelete('cascade');
    });   //
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
