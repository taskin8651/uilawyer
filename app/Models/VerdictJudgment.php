<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VerdictJudgment extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'verdict_judgments';

    protected $fillable = [
        'title',
        'slug',
        'court_name',
        'case_number',
        'citation',
        'author_name',
        'judgment_date',
        'short_description',
        'description',
        'result_summary',
        'is_featured',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'judgment_date' => 'date',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('verdict_image')->singleFile();
        $this->addMediaCollection('verdict_document')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('verdict_image');
    }

    public function getDocumentAttribute()
    {
        return $this->getFirstMediaUrl('verdict_document');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
