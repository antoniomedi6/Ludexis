<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'cover_url', 'first_release_date', 'slug', 'igdb_avg_time', 'community_avg_time', 'weighted_score', 'igdb_id'];

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

    protected $casts = [
        'first_release_date' => 'date',
    ];

    public function weighted_score(): Attribute
    {
        return Attribute::make(
            get: fn($v) => (int) $v,
        );
    }
}