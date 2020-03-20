<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('material_number');
            $table->integer('product_types_id')->unsigned();
            $table->foreign('product_types_id')->references('id')->on('product_types');
            $table->text('description')->nullable()->default(null);
            $table->float('list_price_usd')->nullable()->default(null);
            $table->float('list_price_sgd')->nullable()->default(null);
            $table->integer('product_line')->nullable()->default(null);
            $table->integer('countries_id')->unsigned()->nullable()->default(null);
            $table->foreign('countries_id')->references('id')->on('countries');
            $table->string('origin_company')->nullable()->default(null);
            $table->integer('material_status');
            $table->date('st51_since')->nullable()->default(null);
            $table->date('st52_since')->nullable()->default(null);
            $table->text('sales_replaced_by')->nullable()->default(null);
            $table->text('no_sales_in')->nullable()->default(null);
            $table->integer('quantity_pu_1')->nullable()->default(null);
            $table->integer('quantity_pu_2')->nullable()->default(null);
            $table->integer('quantity_pu_3')->nullable()->default(null);
            $table->integer('quantity_pu_4')->nullable()->default(null);
            $table->float('net_weight')->nullable()->default(null);
            $table->float('gross_weight')->nullable()->default(null);
            $table->float('volume_pu_1')->nullable()->default(null);
            $table->float('volume_pu_2')->nullable()->default(null);
            $table->float('volume_pu_3')->nullable()->default(null);
            $table->float('volume_pu_4')->nullable()->default(null);
            $table->string('unit_volume')->nullable()->default(null);
            $table->string('base_unit')->nullable()->default(null);
            $table->string('weight_unit')->nullable()->default(null);
            $table->text('step_relevant')->nullable()->default(null);
            $table->text('product_hierarchy')->nullable()->default(null);
            $table->text('pm')->nullable()->default(null);
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
