<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tmdb\Laravel\Facades\Tmdb;


class UserController extends Controller
{
    public function userMovies()
    {
        $favourites = User::find(Auth::user()->id)->favourite;
        $watched = User::find(Auth::user()->id)->watched;
        $watchlist = User::find(Auth::user()->id)->watchlist;

        $favouriteIdArray = [];
        $favouriteNameArray = [];
        $favouritePosterArray = [];

        $watchedIdArray = [];
        $watchedNameArray = [];
        $watchedPosterArray = [];

        $watchlistIdArray = [];
        $watchlistNameArray = [];
        $watchlistPosterArray = [];

        foreach($favourites as $favourite)
        {
            $movie = Tmdb::getMoviesApi()->getMovie($favourite->movie_id, ['language' => 'pl']);
            array_push($favouriteIdArray, $favourite->movie_id);
            array_push($favouriteNameArray, $movie['title']);
            array_push($favouritePosterArray, $movie['poster_path']);
        }

        foreach($watched as $watch)
        {
            $movie = Tmdb::getMoviesApi()->getMovie($watch->movie_id, ['language' => 'pl']);
            array_push($watchedIdArray, $watch->movie_id);
            array_push($watchedNameArray, $movie['title']);
            array_push($watchedPosterArray, $movie['poster_path']);
        }

        foreach($watchlist as $watchlist)
        {
            $movie = Tmdb::getMoviesApi()->getMovie($watchlist->movie_id, ['language' => 'pl']);
            array_push($watchlistIdArray, $watchlist->movie_id);
            array_push($watchlistNameArray, $movie['title']);
            array_push($watchlistPosterArray, $movie['poster_path']);
        }

        $tvFavourites = User::find(Auth::user()->id)->tv_favourite;
        $tvWatched = User::find(Auth::user()->id)->tv_watched;
        $tvWatchlist = User::find(Auth::user()->id)->tv_watchlist;

        $tvFavouriteIdArray = [];
        $tvFavouriteNameArray = [];
        $tvFavouritePosterArray = [];

        $tvWatchedIdArray = [];
        $tvWatchedNameArray = [];
        $tvWatchedPosterArray = [];

        $tvWatchlistIdArray = [];
        $tvWatchlistNameArray = [];
        $tvWatchlistPosterArray = [];

        foreach($tvFavourites as $favourite)
        {
            $movie = Tmdb::getTvApi()->getTvshow($favourite->movie_id, ['language' => 'pl']);
            array_push($tvFavouriteIdArray, $favourite->movie_id);
            array_push($tvFavouriteNameArray, $movie['name']);
            array_push($tvFavouritePosterArray, $movie['poster_path']);
        }

        foreach($tvWatched as $watch)
        {
            $movie = Tmdb::getTvApi()->getTvshow($watch->movie_id, ['language' => 'pl']);
            array_push($tvWatchedIdArray, $watch->movie_id);
            array_push($tvWatchedNameArray, $movie['name']);
            array_push($tvWatchedPosterArray, $movie['poster_path']);
        }

        foreach($tvWatchlist as $watchlist)
        {
            $movie = Tmdb::getTvApi()->getTvshow($watchlist->movie_id, ['language' => 'pl']);
            array_push($tvWatchlistIdArray, $watchlist->movie_id);
            array_push($tvWatchlistNameArray, $movie['name']);
            array_push($tvWatchlistPosterArray, $movie['poster_path']);
        }

        return view('user_movies', compact(
            'favouriteIdArray',
            'favouriteNameArray',
            'favouritePosterArray',

            'watchedIdArray',
            'watchedNameArray',
            'watchedPosterArray',

            'watchlistIdArray',
            'watchlistNameArray',
            'watchlistPosterArray',
        
        
            'tvFavouriteIdArray',
            'tvFavouriteNameArray',
            'tvFavouritePosterArray',

            'tvWatchedIdArray',
            'tvWatchedNameArray',
            'tvWatchedPosterArray',

            'tvWatchlistIdArray',
            'tvWatchlistNameArray',
            'tvWatchlistPosterArray'
        ));
    }
}
