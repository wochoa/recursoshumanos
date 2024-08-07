<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biotime extends Model
{
    use HasFactory;
    protected $connection = 'marcacion';
    // protected $table='iclock_transaction';
}
