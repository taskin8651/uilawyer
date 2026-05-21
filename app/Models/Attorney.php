<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Attorney extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'attorneys';

    protected $fillable = [
        'name',
        'designation',
        'badge',
        'meta_items',
        'tags',
        'profile_button_text',
        'profile_button_url',
        'consult_button_text',
        'consult_button_url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'meta_items' => 'array',
        'tags'       => 'array',
        'status'     => 'boolean',
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