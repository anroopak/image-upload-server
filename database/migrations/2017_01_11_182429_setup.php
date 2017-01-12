<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

namespace App\Http\Controllers;

class Setup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ProductController::$TABLE_NAME, function(Blueprint $table){
            $table->increments('product_id');
            $table->string('name');
            $table->double('price');
            $table->timestamps();
        });

        Schema::create(ImageController::$TABLE_NAME, function(Blueprint $table){
            $table->increments('image_id');
            $table->string('name');  // Describing name - Eg. Front views.
            $table->string('path');  // Path of the Image (Local / Amazon S3 Location)
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on(ProductController::TABLE_NAME); 
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
        Schema::dropIfExists(ImageController::$TABLE_NAME);
        Schema::dropIfExists(ProductController::TABLE_NAME);
    }
}
