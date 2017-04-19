<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvWatchlist extends Model
{
    protected $table = 'tv_watchlist';
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
