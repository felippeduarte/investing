<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('investment_type_id')->unsigned();
            $table->integer('risk_level_id')->unsigned();
            $table->integer('financial_instituion_id')->unsigned();
            $table->integer('investment_period_id')->unsigned();
            $table->decimal('value', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('investment_type_id')->references('id')->on('investment_types');
            $table->foreign('risk_level_id')->references('id')->on('risk_levels');
            $table->foreign('financial_instituion_id')->references('id')->on('financial_instituions');
            $table->foreign('investment_period_id')->references('id')->on('investment_periods');
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
