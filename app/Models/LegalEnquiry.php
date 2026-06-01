<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LegalEnquiry extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable;

    public $table = 'legal_enquiries';

    protected $fillable = [
        'form_type',
        'full_name',
        'mobile',
        'email',
        'case_category',
        'city_state',
        'preferred_contact_mode',
        'preferred_date',
        'preferred_time',
        'case_message',
        'consent',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'consent' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('case_document')->singleFile();
    }

    public function getDocumentAttribute()
    {
        return $this->getFirstMediaUrl('case_document');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
