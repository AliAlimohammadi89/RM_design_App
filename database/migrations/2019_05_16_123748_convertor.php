<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Convertor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('convertors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Shop_key');
            $table->string('Shop_code');
            $table->string('Shop_description');
            $table->string('Parent_id');
            $table->string('Page_permission');
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
