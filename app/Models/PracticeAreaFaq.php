<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticeAreaFaq extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'practice_area_faqs';

    protected $fillable = [
        'practice_area_id',
        'question',
        'answer',
        'status',
        'sort_order',
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
