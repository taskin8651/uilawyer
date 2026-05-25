<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FounderMessage extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'founder_messages';

    protected $fillable = [
        'kicker_icon',
        'kicker_text',
        'title',
        'description',
        'quote_icon',
        'quote_text',
        'founder_name',
        'founder_designation',
        'card_name',
        'card_designation',
        'meta_items',
    ];

    protected $casts = [
        'meta_items' => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('founder_image')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('founder_image');
    }
}
