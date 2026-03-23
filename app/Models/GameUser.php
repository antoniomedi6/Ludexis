<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $table = 'game_user';
    protected $fillable = ['status', 'review', 'weight_applied', 'hours_finish', 'hours_completed', 'rating', 'drop_reason', 'game_id', 'user_id'];
}