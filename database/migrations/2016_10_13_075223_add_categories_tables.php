<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image')->default('/img/NOIMAGE.JPG');
            $table->timestamps();
        });

        if(Schema::hasColumn('posts','category_id')){

        }else{
            Schema::table('posts',function(Blueprint $table){
                $table->integer('category_id')->unsigned();

                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('posts', function ($table) {
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('categories');
    }
}
