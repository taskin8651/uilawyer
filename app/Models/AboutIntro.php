<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutIntro extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'about_intros';

    protected $fillable = [
        'kicker_icon',
        'kicker_text',
        'title',
        'description_one',
        'description_two',
        'experience_number',
        'experience_text',
        'note_icon',
        'note_small_text',
        'note_title',
        'points',
    ];

    protected $casts = [
        'points' => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('about_intro_image')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('about_intro_image');
    }
}