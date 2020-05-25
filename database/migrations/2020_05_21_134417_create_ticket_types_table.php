<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        Schema::create('ticket_responses', function (Blueprint $table) {
            $table->id();
            $table->string('response');
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('ticket_responses');
    }
}
