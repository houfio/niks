<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIntakeToInterview extends Migration
{
    public function up()
    {
        Schema::rename('intakes', 'interviews');
    }

    public function down()
    {
        Schema::rename('interviews', 'intakes');
    }
}
