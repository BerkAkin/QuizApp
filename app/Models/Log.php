<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['IslemTuru', 'Islem', 'IslemiYapan', 'IpAdresi', 'created_at', 'updated_at'];
    protected $dates = ['finished_at'];
}