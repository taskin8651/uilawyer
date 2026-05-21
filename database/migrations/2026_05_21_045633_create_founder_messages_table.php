<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFounderMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('founder_messages', function (Blueprint $table) {
            $table->id();
            $table->string('kicker_icon')->nullable();
            $table->string('kicker_text')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();

            $table->string('quote_icon')->nullable();
            $table->longText('quote_text')->nullable();

            $table->string('founder_name')->nullable();
            $table->string('founder_designation')->nullable();
            $table->string('card_name')->nullable();
            $table->string('card_designation')->nullable();

            $table->json('meta_items')->nullable();

            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('founder_messages');
    }
}