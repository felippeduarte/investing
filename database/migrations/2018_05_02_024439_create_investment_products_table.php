<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('financial_institution_id')->unsigned();
            $table->integer('investment_type_id')->unsigned();
            $table->integer('risk_level_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('financial_institution_id')->references('id')->on('financial_institutions');
            $table->foreign('investment_type_id')->references('id')->on('investment_types');
            $table->foreign('risk_level_id')->references('id')->on('risk_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
