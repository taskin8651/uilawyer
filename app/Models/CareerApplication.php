<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CareerApplication extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'career_applications';

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'city_state',
        'college_university',
        'course_year',
        'internship_type',
        'practice_area_interest',
        'preferred_start_date',
        'preferred_duration',
        'message',
        'consent',
        'status',
    ];

    protected $casts = [
        'preferred_start_date' => 'date',
        'consent' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('resume')->singleFile();
        $this->addMediaCollection('id_proof')->singleFile();
    }

    public function getResumeAttribute()
    {
        return $this->getFirstMediaUrl('resume');
    }

    public function getIdProofAttribute()
    {
        return $this->getFirstMediaUrl('id_proof');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
