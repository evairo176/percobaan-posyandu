<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skdn extends Model
{
    use HasFactory;
    protected $table = 'tb_skdn';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
