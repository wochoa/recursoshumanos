<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reginicidencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','inicidencias','fecha','hora','sectores','created_at','updated_at',
    ];
    protected $table = 'reginicidencias';
}
