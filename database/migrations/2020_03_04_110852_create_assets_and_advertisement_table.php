<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsAndAdvertisementTable extends Migration
{
    public function up()
    {
        Schema::create('advertisement_asset', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('advertisement_id')->unsigned();
            $table->integer('asset_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets_advertisements');
    }
}
