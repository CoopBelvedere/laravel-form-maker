<?php

use Illuminate\{
    Support\Facades\Schema,
    Database\Schema\Blueprint,
    Database\Migrations\Migration
};

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

        Schema::create(config('form-maker.database.form_nodes_table', 'form_nodes'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('nodable');
            $table->string('component');
            $table->string('type');
            $table->json('html_attributes')->nullable();
            $table->json('rules')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });

        Schema::create(config('form-maker.database.rankings_table', 'rankings'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('rankable');
            $table->json('ranks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(config('form-maker.database.rankings_table', 'rankings'));
        Schema::drop(config('form-maker.database.form_nodes_table', 'form_nodes'));
        Schema::drop(config('form-maker.database.forms_table', 'forms'));
    }
}
