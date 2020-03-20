<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_for')->nullable()->default(null);
            $table->integer('customers_id')->unsigned()->nullable()->default(null);
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->string('currency')->nullable()->default(null);
            $table->string('refrence_number')->nullable()->default(null);
            $table->string('revision')->nullable()->default(null);
            $table->string('project_name')->nullable()->default(null);
            $table->text('remarks');
            $table->date('validity')->nullable()->default(null);
            $table->string('incoterm')->nullable()->default(null);
            $table->string('payment')->nullable()->default(null);
            $table->float('quotation_cost')->nullable()->default(null);
            $table->enum('status',['DRAFTED', 'PENDING', 'APPROVED', 'REJECTED'])->nullable()->default(null);
            $table->text('reason');
            $table->text('project_detail');
            $table->string('project_location')->nullable()->default(null);
            $table->text('strategic_reason');
            $table->text('competition');
            $table->string('chance_improvement')->nullable()->default(null);
            $table->date('delivery_schedule')->nullable()->default(null);
            $table->string('distributor_margin')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('assigned_to')->nullable()->default(null);
            $table->integer('approved_by')->nullable()->default(null);
            $table->integer('last_updated_by')->nullable()->default(null);
            $table->softDeletes();
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
        Schema::dropIfExists('quotations');
    }
}
