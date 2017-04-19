<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    protected $table = 'watchlist';
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
