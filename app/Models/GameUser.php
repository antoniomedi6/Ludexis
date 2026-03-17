<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $table = 'game_user';
    protected $fillable = ['status', 'hours_finish', 'hours_completed', 'rating', 'drop_reason', 'game_id', 'user_id'];
}