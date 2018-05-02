<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investment_product_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->decimal('value',10,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('investment_product_id')->references('id')->on('investment_products');
            $table->foreign('period_id')->references('id')->on('periods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_returns');
    }
}
