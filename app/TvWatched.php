<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvWatched extends Model
{
    protected $table = 'tv_watched';
    protected $fillable = [
        'user_id', 'movie_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
