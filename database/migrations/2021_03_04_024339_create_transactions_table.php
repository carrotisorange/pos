<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id', false, true)->length(10);
            // $table->unsignedBigInteger('cus_id')->nullable();
            // $table->foreign('cus_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('inv_id')->nullable();
            $table->foreign('inv_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->unsignedBigInteger('usr_id')->nullable();
            $table->foreign('usr_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('amt', 8,2);
            $table->enum('type', ['debit', 'credit', 'cash']);
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
        Schema::dropIfExists('transactions');
    }
}
