<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sispermiso extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name','guard_name','created_at','updated_at',
    ];
    protected $table = 'permissions';
}
