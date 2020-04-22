<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount');
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
