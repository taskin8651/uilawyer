<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_category_id')
                ->nullable()
                ->constrained('article_categories')
                ->nullOnDelete();

            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('author_name')->nullable();
            $table->date('published_date')->nullable();

            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('read_more_text')->nullable();
            $table->string('read_more_url')->nullable();

            $table->boolean('is_latest')->default(1);
            $table->boolean('status')->default(1);
            $table->integer('sort_order')->default(0);

            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}