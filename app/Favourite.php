<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourite';
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
