<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeAreaServicesTable extends Migration
{
    public function up()
    {
        Schema::create('practice_area_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_area_id')
                ->nullable()
                ->constrained('practice_areas')
                ->nullOnDelete();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('icon_class')->nullable();
            $table->longText('short_description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('url')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('practice_area_services');
    }
}
