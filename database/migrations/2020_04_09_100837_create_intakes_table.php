<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntakesTable extends Migration
{
    public function up()
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inviter_id');
            $table->unsignedBigInteger('invitee_id');
            $table->dateTime('date');
            $table->boolean('accepted')->default(false);
            $table->timestamps();

            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('invitee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('intakes');
    }
}
