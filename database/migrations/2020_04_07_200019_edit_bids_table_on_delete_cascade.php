<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditBidsTableOnDeleteCascade extends Migration
{
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign('bids_advertisement_id_foreign');
            $table->dropForeign('bids_user_id_foreign');
            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign('bids_advertisement_id_foreign');
            $table->dropForeign('bids_user_id_foreign');
            $table->foreign('advertisement_id')->references('id')->on('advertisements');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
