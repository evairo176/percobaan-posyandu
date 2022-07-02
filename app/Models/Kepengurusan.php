<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepengurusan extends Model
{
    use HasFactory;
    protected $table = 'tb_kepengurusan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
