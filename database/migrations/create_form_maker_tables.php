<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormMakerTables extends Migration
{
    public function up()
    {
        Schema::create(config('form-maker.database.forms_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->json('html_attributes')->nullable();
            $table->timestamps();
        });

        Schema::create(config('form-maker.database.inputs_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('inputable');
            $table->string('type');
            $table->json('html_attributes')->nullable();
            $table->json('rules')->nullable();
            $table->string('text')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('inputs');
        Schema::drop('forms');
    }
}
