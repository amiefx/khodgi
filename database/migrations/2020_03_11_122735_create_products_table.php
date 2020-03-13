<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('category_id');
            $table->string('description')->nullable();
            $table->boolean('isActive')->default(true);
            $table->string('price_pkr');
            $table->string('price_usd');
            $table->string('price_aud');
            $table->string('price_eur');
            $table->string('price_gbp');
            $table->string('special_price_percentage')->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->string('image1');
            $table->string('image2');
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->date('new_from')->nullable();
            $table->date('new_to')->nullable();
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
        Schema::dropIfExists('products');
    }
}
