<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'articles';

    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'author_name',
        'published_date',
        'short_description',
        'description',
        'read_more_text',
        'read_more_url',
        'is_latest',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_latest'      => 'boolean',
        'status'         => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article_image')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('article_image');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}