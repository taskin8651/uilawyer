<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutIntrosTable extends Migration
{
    public function up()
    {
        Schema::create('about_intros', function (Blueprint $table) {
            $table->id();
            $table->string('kicker_icon')->nullable();
            $table->string('kicker_text')->nullable();
            $table->string('title')->nullable();
            $table->longText('description_one')->nullable();
            $table->longText('description_two')->nullable();

            $table->string('experience_number')->nullable();
            $table->string('experience_text')->nullable();

            $table->string('note_icon')->nullable();
            $table->string('note_small_text')->nullable();
            $table->string('note_title')->nullable();

            $table->json('points')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_intros');
    }
}