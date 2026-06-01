<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Attorney extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'attorneys';

    protected $fillable = [
        'name',
        'designation',
        'place_of_practice',
        'experience',
        'address',
        'phone',
        'email',
        'about_team',
        'biography',
        'qualifications',
        'practice_areas_text',
        'courts_represented',
        'languages_spoken',
        'profile_summary',
        'badge',
        'meta_items',
        'tags',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'meta_items' => 'array',
        'tags'       => 'array',
        'status' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attorney_image')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('attorney_image');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
