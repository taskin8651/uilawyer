<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetaTag extends Model
{
    use SoftDeletes, Auditable;

    protected $fillable = ['page_name', 'page_key', 'meta_title', 'meta_description', 'meta_keywords', 'status'];

    protected $casts = ['status' => 'boolean'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
