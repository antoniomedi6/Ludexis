<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\ExperienceService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'xp',
        'is_private',
        'provider_name',
        'provider_id',
        'provider_token',
        'banned_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'rank_details',
        'rank_progress_percentage'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_user')
            ->withPivot(['status', 'rating', 'hours_finish', 'hours_completed', 'review']);
    }

    public function customLists(): HasMany
    {
        return $this->hasMany(CustomList::class);
    }

    /**
     * Sobrescribe la foto de perfil por defecto para asignar colores por rol.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(''));

        $background = match ($this->role) {
            'admin' => 'DC2626',
            'journalist' => '4F46E5',
            'veteran' => 'EAB308',
            default => '374151',
        };

        $color = match ($this->role) {
            'veteran' => '713F12',
            default => 'FFFFFF',
        };

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=' . $color . '&background=' . $background;
    }

    /**
     * Obtiene el rango y color basado en el ExperienceService.
     */
    public function getRankDetailsAttribute(): array
    {
        return ExperienceService::getCurrentRank($this);
    }

    /**
     * Calcula el progreso hacia el siguiente rango (0 a 100).
     */
    public function getRankProgressPercentageAttribute(): int
    {
        $currentRank = $this->rank_details;
        $nextRank = ExperienceService::getNextRank($this);

        if (!$nextRank)
            return 100;

        $xpInLevel = $this->xp - $currentRank['xp_required'];
        $xpRequired = $nextRank['xp_required'] - $currentRank['xp_required'];

        return (int) (($xpInLevel / $xpRequired) * 100);
    }
}