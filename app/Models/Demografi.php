<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demografi extends Model
{
    use HasFactory;
    protected $table = 'tb_demografi';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
