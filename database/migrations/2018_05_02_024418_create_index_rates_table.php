<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('index_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->decimal('value',10,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('index_id')->references('id')->on('indices');
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
        Schema::dropIfExists('index_rates');
    }
}
