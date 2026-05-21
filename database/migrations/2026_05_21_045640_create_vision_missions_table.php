<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionMissionsTable extends Migration
{
    public function up()
    {
        Schema::create('vision_missions', function (Blueprint $table) {
            $table->id();
            $table->string('kicker_icon')->nullable();
            $table->string('kicker_text')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();

            $table->string('vision_icon')->nullable();
            $table->string('vision_title')->nullable();
            $table->longText('vision_text')->nullable();

            $table->string('mission_icon')->nullable();
            $table->string('mission_title')->nullable();
            $table->longText('mission_text')->nullable();

            $table->string('values_icon')->nullable();
            $table->string('values_title')->nullable();
            $table->longText('values_text')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vision_missions');
    }
}