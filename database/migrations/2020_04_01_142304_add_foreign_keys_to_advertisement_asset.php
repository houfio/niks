<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdvertisementAsset extends Migration
{
    public function up()
    {
        Schema::rename('advertisement_asset', 'advertisement_assets');
        Schema::table('advertisement_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('advertisement_id')->change();
            $table->unsignedBigInteger('asset_id')->change();
            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('advertisement_assets', function (Blueprint $table) {
            $table->dropForeign('advertisement_id');
            $table->dropForeign('asset_id');
        });
    }
}
