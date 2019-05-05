<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingTables extends Migration
{
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('rankable');
            $table->json('ranks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rankings');
    }
}