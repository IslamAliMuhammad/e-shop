<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')->unsigned();
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained()->onDelete('cascade');
            $table->string('sku');
            $table->integer('stock');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
