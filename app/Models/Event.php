<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
}
