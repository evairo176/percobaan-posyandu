<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table = 'tb_website';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'keterangan', 'picture'];
}
