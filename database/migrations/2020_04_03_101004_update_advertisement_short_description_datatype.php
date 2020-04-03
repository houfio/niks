<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdvertisementShortDescriptionDatatype extends Migration
{
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->longText('short_description')->change();
        });
    }

    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->string('short_description')->change();
        });
    }
}
