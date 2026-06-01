<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwarenessVideo extends Model
{
    use SoftDeletes, Auditable;

    protected $fillable = ['title', 'video_url', 'thumbnail_image', 'short_description', 'status', 'sort_order'];

    protected $casts = ['status' => 'boolean'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
