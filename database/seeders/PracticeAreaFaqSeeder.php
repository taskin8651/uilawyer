<?php

namespace Database\Seeders;

use App\Models\PracticeArea;
use App\Models\PracticeAreaFaq;
use Illuminate\Database\Seeder;

class PracticeAreaFaqSeeder extends Seeder
{
    public function run(): void
    {
        PracticeArea::orderBy('sort_order')->get()->each(function (PracticeArea $practiceArea) {
            if ($practiceArea->faqs()->exists()) {
                return;
            }

            $title = $practiceArea->title ?: 'this practice area';

            $faqs = [
                [
                    'question' => "What documents are usually required for {$title}?",
                    'answer' => 'Basic identity proof, notices, case papers, messages, receipts, orders or other documents connected with the legal issue are usually helpful.',
                ],
                [
                    'question' => 'What should a client do first?',
                    'answer' => 'Collect the important facts and documents, avoid informal admissions, and seek legal consultation before taking further steps.',
                ],
                [
                    'question' => 'When should a lawyer be contacted?',
                    'answer' => 'A lawyer should be contacted early when a notice, police issue, family dispute, property conflict, court date or urgent legal risk is involved.',
                ],
            ];

            foreach ($faqs as $index => $faq) {
                PracticeAreaFaq::create([
                    'practice_area_id' => $practiceArea->id,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                    'status' => 1,
                    'sort_order' => $index + 1,
                ]);
            }
        });
    }
}
