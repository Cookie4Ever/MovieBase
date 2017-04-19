<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function watchlist()
    {
        return $this->hasMany('App\Watchlist');
    }

    public function watched()
    {
        return $this->hasMany('App\Watched');
    }

    public function favourite()
    {
        return $this->hasMany('App\Favourite');
    }

    public function tv_watchlist()
    {
        return $this->hasMany('App\TvWatchlist');
    }

    public function tv_watched()
    {
        return $this->hasMany('App\TvWatched');
    }

    public function tv_favourite()
    {
        return $this->hasMany('App\TvFavourite');
    }

    public function review()
    {
        return $this->hasMany('App\Review');
    }
}
