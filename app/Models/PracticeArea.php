<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PracticeArea extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'practice_areas';

    protected $fillable = [
        'title',
        'slug',
        'icon_class',
        'button_text',
        'short_description',
        'description',
        'issue_overview',
        'legal_position',
        'remedies',
        'documents_required',
        'process_overview',
        'when_to_consult_lawyer',
        'faq_items',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'status' => 'boolean',
        'faq_items' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('practice_area_image')->singleFile();
    }

    public function services()
    {
        return $this->hasMany(PracticeAreaService::class, 'practice_area_id');
    }

    public function faqs()
    {
        return $this->hasMany(PracticeAreaFaq::class, 'practice_area_id');
    }

    public function activeFaqs()
    {
        return $this->hasMany(PracticeAreaFaq::class, 'practice_area_id')
            ->where('status', 1)
            ->orderBy('sort_order');
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('practice_area_image');
    }

    public function getDisplayFaqItemsAttribute(): array
    {
        $faqSource = $this->relationLoaded('activeFaqs')
            ? $this->activeFaqs
            : $this->activeFaqs()->get();

        $faqItems = $faqSource
            ->map(function (PracticeAreaFaq $faq) {
                return [
                    'question' => trim($faq->question ?? ''),
                    'answer' => trim($faq->answer ?? ''),
                ];
            })
            ->filter(fn ($item) => $item['question'] !== '' || $item['answer'] !== '')
            ->values()
            ->all();

        if ($faqItems) {
            return $faqItems;
        }

        $legacyFaqItems = collect($this->faq_items ?? [])
            ->map(function ($item) {
                return [
                    'question' => trim($item['question'] ?? ''),
                    'answer' => trim($item['answer'] ?? ''),
                ];
            })
            ->filter(fn ($item) => $item['question'] !== '' || $item['answer'] !== '')
            ->values()
            ->all();

        return $legacyFaqItems ?: $this->defaultFaqItems();
    }

    public function defaultFaqItems(): array
    {
        $practiceTitle = $this->title ?: 'this practice area';

        return [
            [
                'question' => "What documents are usually required for {$practiceTitle}?",
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
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
