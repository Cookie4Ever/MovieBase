<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'body', 'title', 'rating'
    ];

    protected $table = 'review';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
