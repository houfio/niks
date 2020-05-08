<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAdvertisementAskingToIsAsking extends Migration
{
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->renameColumn('asking', 'is_asking');
        });
    }

    public function down()
    {
        Schema::table('is_asking', function (Blueprint $table) {
            $table->renameColumn('is_asking', 'asking');
        });
    }
}
