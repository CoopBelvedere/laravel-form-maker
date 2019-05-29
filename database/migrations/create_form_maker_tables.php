<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormMakerTables extends Migration
{
    public function up()
    {
        Schema::create(config('form-maker.database.forms_table', 'forms'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->json('html_attributes')->nullable();
            $table->timestamps();
        });

        Schema::create(config('form-maker.database.inputs_table', 'inputs'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('inputable');
            $table->string('type');
            $table->json('html_attributes')->nullable();
            $table->json('rules')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });

        Schema::create(config('form-maker.database.siblings_table', 'siblings'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('siblingable');
            $table->string('type');
            $table->json('html_attributes')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });

        Schema::create(config('form-maker.database.rankings_table', 'rankings'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('node_type');
            $table->morphs('rankable');
            $table->json('ranks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('form-maker.database.rankings_table', 'rankings'));
        Schema::drop(config('form-maker.database.siblings_table', 'siblings'));
        Schema::drop(config('form-maker.database.inputs_table', 'inputs'));
        Schema::drop(config('form-maker.database.forms_table', 'forms'));
    }
}
