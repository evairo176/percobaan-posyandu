<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geografi extends Model
{
    use HasFactory;
    protected $table = 'tb_geografi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
