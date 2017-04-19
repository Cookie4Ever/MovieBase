<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watched extends Model
{
    protected $table = 'watched';
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
