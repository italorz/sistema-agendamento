<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hora extends Model
{
    protected $fillable = [
        'id_hora',
        'hora'
    ];
    use HasFactory;
}
