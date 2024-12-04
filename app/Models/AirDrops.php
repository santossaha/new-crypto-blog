<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirDrops extends Model
{
    use HasFactory;

    protected $table = "air_drops";
    public $timestamps = true;
}
