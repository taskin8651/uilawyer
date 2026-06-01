<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'testimonials';

    protected $fillable = [
        'client_name',
        'client_designation',
        'rating',
        'review',
        'sort_order',
        'status',
        'approval_status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'rating' => 'integer',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
