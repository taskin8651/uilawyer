<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttorneysTable extends Migration
{
    public function up()
    {
        Schema::create('attorneys', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('badge')->nullable();

            $table->json('meta_items')->nullable();
            $table->json('tags')->nullable();

            $table->string('profile_button_text')->nullable();
            $table->string('profile_button_url')->nullable();

            $table->string('consult_button_text')->nullable();
            $table->string('consult_button_url')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attorneys');
    }
}