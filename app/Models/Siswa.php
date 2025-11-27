<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Siswa extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'nis',
        'class',
        'jurusan_id',
        'email',
        'phone',
        'achievement_title',
        'achievement_description',
        'competition_name',
        'achievement_level',
        'achievement_year',
        'achievement_category',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
