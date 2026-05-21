<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisionMission extends Model
{
    use SoftDeletes;

    public $table = 'vision_missions';

    protected $fillable = [
        'kicker_icon',
        'kicker_text',
        'title',
        'description',
        'vision_icon',
        'vision_title',
        'vision_text',
        'mission_icon',
        'mission_title',
        'mission_text',
        'values_icon',
        'values_title',
        'values_text',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}