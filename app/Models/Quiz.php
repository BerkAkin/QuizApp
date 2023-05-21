<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'finished_at', 'status', 'slug', 'sahip', 'counter', 'kisi_sayisi', 'gereken_min_not'];
    protected $dates = ['finished_at'];



    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }


    public function siralama()
    {
        return $this->results()->orderByDesc('score')->take(4);
    }

    public function myResult()
    {
        if ($this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id)) {
            return $this->hasOne('App\Models\Result')->where('user_id', auth()->user()->id);
        } else {
            return;
        }
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) : null;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'onUpdate' => true,
                'source' => 'title'
            ]
        ];
    }


}