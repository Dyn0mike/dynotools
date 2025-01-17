<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'region',
        'length',
        'type',
        'price',
        'quantity',
        'discord'
    ];
}
