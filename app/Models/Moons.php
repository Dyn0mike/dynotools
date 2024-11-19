<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moons extends Model
{
    public $table = 'Moons';
    use HasFactory;
    public $timestamps = false;
}
