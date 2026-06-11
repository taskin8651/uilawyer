<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('practice_area_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_area_id')
                ->constrained('practice_areas')
                ->cascadeOnDelete();
            $table->string('question', 500)->nullable();
            $table->longText('answer')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        if (Schema::hasColumn('practice_areas', 'faq_items')) {
            DB::table('practice_areas')
                ->whereNotNull('faq_items')
                ->orderBy('id')
                ->get(['id', 'faq_items'])
                ->each(function ($practiceArea) {
                    $faqItems = json_decode($practiceArea->faq_items, true);

                    if (!is_array($faqItems)) {
                        return;
                    }

                    foreach (array_values($faqItems) as $index => $item) {
                        $question = trim((string) ($item['question'] ?? ''));
                        $answer = trim((string) ($item['answer'] ?? ''));

                        if ($question === '' && $answer === '') {
                            continue;
                        }

                        DB::table('practice_area_faqs')->insert([
                            'practice_area_id' => $practiceArea->id,
                            'question' => $question,
                            'answer' => $answer,
                            'status' => 1,
                            'sort_order' => $index,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_area_faqs');
    }
};
