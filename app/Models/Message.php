<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['gonderen_id', 'alici_id', 'mesaj', 'baslik', 'okundu_bilgisi'];
}