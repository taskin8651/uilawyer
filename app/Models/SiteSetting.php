<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $table = 'site_settings';

    protected $fillable = [
        'site_name',
        'tagline',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'address_short',
        'address_full',
        'phone',
        'whatsapp',
        'email',
        'office_hours',
        'map_title',
        'map_embed_url',
        'map_direction_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'copyright_text',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            static::defaults()
        );
    }

    public static function defaults(): array
    {
        return [
            'site_name' => 'Rajpati & Associates',
            'tagline' => 'Best Law Firm Since 1999',
            'seo_title' => 'Rajpati & Associates | Best Law Firm in Patna Since 1999',
            'seo_description' => 'Rajpati & Associates provides All India Legal Services for divorce, criminal law, civil law, Muslim law, service matters, cyber law, property disputes, bail and legal notices.',
            'seo_keywords' => 'law firm in Patna, lawyer in Patna, legal services, Rajpati and Associates',
            'address_short' => 'Tilak Nagar Road, Rukanpura, Patna',
            'address_full' => 'Tilak Nagar Road, Navneet Nagar, Rukanpura, Baily Road, Patna, Bihar 800014',
            'phone' => '+91 94310 21093',
            'whatsapp' => '+91 91175 77770',
            'email' => 'info@rajpatiandassociates.com',
            'office_hours' => 'Monday - Saturday, Consultation by appointment',
            'map_title' => 'Rajpati & Associates',
            'map_embed_url' => 'https://www.google.com/maps?q=Tilak%20Nagar%20Road%20Navneet%20Nagar%20Rukanpura%20Baily%20Road%20Patna%20Bihar%20800014&output=embed',
            'map_direction_url' => 'https://www.google.com/maps/search/?api=1&query=Tilak+Nagar+Road+Navneet+Nagar+Rukanpura+Baily+Road+Patna+Bihar+800014',
            'copyright_text' => 'Copyright 1999-2026 Rajpati & Associates. All Rights Reserved.',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('site_logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
        $this->addMediaCollection('seo_image')->singleFile();
    }

    public function getLogoAttribute()
    {
        return $this->getFirstMediaUrl('site_logo');
    }

    public function getFaviconAttribute()
    {
        return $this->getFirstMediaUrl('favicon');
    }

    public function getSeoImageAttribute()
    {
        return $this->getFirstMediaUrl('seo_image');
    }

    public function getPhoneLinkAttribute(): string
    {
        return 'tel:' . preg_replace('/\D+/', '', $this->phone ?? '');
    }

    public function getWhatsappLinkAttribute(): string
    {
        return 'https://wa.me/' . preg_replace('/\D+/', '', $this->whatsapp ?? '');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
