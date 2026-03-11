<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_url',
        'country',
        'start_date'
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'company_game', 'company_id', 'game_id')
            ->withPivot('is_developer', 'is_publisher')
            ->withTimestamps();
    }
}