<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssetRelationsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('header_id')->nullable()->unsigned();
            $table->bigInteger('avatar_id')->nullable()->unsigned();
            $table->foreign('header_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('avatar_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['header_id']);
            $table->dropForeign(['avatar_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('header_id');
            $table->dropColumn('avatar_id');
        });
    }
}
