<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_pivot', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tx_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('to_id')->unsigned();
            
            $table->timestamps();
        });

        Schema::table('transaction_pivot', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('tx_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_pivot');
    }
}

