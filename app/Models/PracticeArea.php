<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PracticeArea extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'practice_areas';

    protected $fillable = [
        'title',
        'slug',
        'icon_class',
        'button_text',
        'short_description',
        'description',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('practice_area_image')->singleFile();
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
