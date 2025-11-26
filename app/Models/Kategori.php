<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category', 'name');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = \Illuminate\Support\Str::slug($kategori->name);
            }
        });

        static::updating(function ($kategori) {
            if ($kategori->isDirty('name')) {
                $kategori->slug = \Illuminate\Support\Str::slug($kategori->name);
            }
        });
    }
}
