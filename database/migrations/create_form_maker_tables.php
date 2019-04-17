<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormMakerTables extends Migration
{
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->json('html_attributes')->nullable();
            $table->timestamps();
        });

        Schema::create('inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('inputable');
            $table->string('type');
            $table->json('html_attributes')->nullable();
            $table->json('rules')->nullable();
            $table->timestamps();
        });

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
        Schema::drop('inputs');
        Schema::drop('forms');
    }
}
