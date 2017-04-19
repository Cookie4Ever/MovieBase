<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvReview extends Model
{
    protected $fillable = [
        'body', 'title', 'rating'
    ];

    protected $table = 'tv_review';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
