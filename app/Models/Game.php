<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'cover_url', 'video_url', 'first_release_date', 'slug', 'rating', 'igdb_rating', 'avg_time', 'screenshots', 'artworks', 'igdb_id'];
    protected $casts = [
        'first_release_date' => 'date',
        'screenshots' => 'array',
        'artworks' => 'array'
    ];

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function customLists(): BelongsToMany
    {
        return $this->belongsToMany(CustomList::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_game', 'game_id', 'company_id')
            ->withPivot('is_developer', 'is_publisher')
            ->withTimestamps();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function rating(): Attribute
    {
        return Attribute::make(
            get: fn($v) => (int) $v,
            set: fn($v) => (int) $v,
        );
    }

    public function getScreenshotUrlsAttribute()
    {
        if (!$this->screenshots) {
            return [];
        }

        return array_map(function ($hash) {
            return "https://images.igdb.com/igdb/image/upload/t_1080p/{$hash}.jpg";
        }, $this->screenshots);
    }


    protected function spanishSynopsis(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (blank($this->synopsis)) {
                return $this->synopsis;
            }

            $tr = new GoogleTranslate('es');

            return $tr->translate($this->synopsis);
        });
    }
}
