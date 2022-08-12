<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'posyandu_id', 'name', 'email', 'password', 'password_asli', 'picture', 'role', 'gender', 'phone', 'dob', 'status_posyandu', 'status_geografi', 'status_demografi', 'status_pembentukan', 'status_kepengurusan', 'status_sarana', 'status_strata', 'status_skdn', 'status_kegiatan', 'status_program', 'kelurahan_id', 'kecamatan_id'
    ];
}
