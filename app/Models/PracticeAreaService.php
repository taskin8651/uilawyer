<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeAreaService extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'practice_area_services';

    protected $fillable = [
        'practice_area_id',
        'title',
        'slug',
        'icon_class',
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

    public function practiceArea()
    {
        return $this->belongsTo(PracticeArea::class, 'practice_area_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
