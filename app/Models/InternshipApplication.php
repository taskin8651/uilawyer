<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InternshipApplication extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    protected $fillable = [
        'full_name',
        'mobile',
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
        $this->addMediaCollection('aadhar_card')->singleFile();
        $this->addMediaCollection('photograph')->singleFile();
        $this->addMediaCollection('payment_screenshot')->singleFile();
    }

    public function getResumeAttribute()
    {
        return $this->getFirstMediaUrl('resume');
    }

    public function getAadharCardAttribute()
    {
        return $this->getFirstMediaUrl('aadhar_card');
    }

    public function getPhotographAttribute()
    {
        return $this->getFirstMediaUrl('photograph');
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
