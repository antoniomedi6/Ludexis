<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    protected $fillable = [
        'name',
        'platform_family_name',
        'platform_logo_url',
        'slug',
        'abbreviation',
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }

    /* Para no tener que poner la URL en la vista */
    public function logoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $url = $this->platform_logo_url;

                if (!$url) {
                    return null;
                }

                $url = str_starts_with($url, '//') ? 'https:' . $url : $url;

                return str_replace('t_thumb', 't_logo_med', $url);
            }
        );
    }
}
