<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkembangan extends Model
{
    use HasFactory;
    protected $table = 'tb_perkembangan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
