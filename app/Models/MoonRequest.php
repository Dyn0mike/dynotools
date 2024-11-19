<?php

namespace App\Models;

use App\Models\Moons;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MoonRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function User(){
        return $this->belongsTo('App\User');

    }
    public function Moon(): HasOne
    {
        return $this->hasOne(Moons::class,'id','moon_id');
    }
}
