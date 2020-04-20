<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenColumnToIntakesTable extends Migration
{
    public function up()
    {
        Schema::table('intakes', function (Blueprint $table) {
            $table->string('token', 32);
        });
    }

    public function down()
    {
        Schema::table('intakes', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
}
