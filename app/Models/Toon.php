<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toon extends Model
{
    use HasFactory;

    public $primaryKey = 'chid';

    protected $fillable = [
        'chid',
        'user_id',
        'access_token',
        'refresh_token',
        'corporation_id',
        'character_name',
        'alliance_id',
        'expires'
    ];
}
