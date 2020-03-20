<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotations_id')->unsigned()->nullable()->default(null);
            $table->foreign('quotations_id')->references('id')->on('quotations');
            $table->integer('products_id')->unsigned()->nullable()->default(null);
            $table->foreign('products_id')->references('id')->on('products');
            $table->text('product_description');
            $table->string('quantity')->nullable()->default(null);
            $table->string('discount')->nullable()->default(null);
            $table->float('unit_price')->nullable()->default(null);
            $table->float('discount_unit_price')->nullable()->default(null);
            $table->float('total_cost')->nullable()->default(null);
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
        Schema::dropIfExists('product_quotations');
    }
}
