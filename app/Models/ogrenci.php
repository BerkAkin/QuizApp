<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ogrenci extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =['ogretmen_id','ogrenci_id'];

}
