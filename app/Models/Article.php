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
        'submitter_email',
        'submitter_phone',
        'published_date',
        'short_description',
        'description',
        'is_public_submission',
        'is_latest',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_public_submission' => 'boolean',
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
        $this->addMediaCollection('article_document')->singleFile();
        $this->addMediaCollection('payment_screenshot')->singleFile();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('article_image');
    }

    public function getDocumentAttribute()
    {
        return $this->getFirstMediaUrl('article_document');
    }

    public function getPaymentScreenshotAttribute()
    {
        return $this->getFirstMediaUrl('payment_screenshot');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
