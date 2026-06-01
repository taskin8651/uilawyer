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

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('practice_area_image');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
