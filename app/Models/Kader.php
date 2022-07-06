<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;
    protected $table = 'tb_kader';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
