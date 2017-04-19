<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Laravel\Facades\Tmdb;
use App\Favourite;
use App\Watched;
use App\Watchlist;
use App\Review;
use Illuminate\Support\Facades\Auth;
use DB;
use URL;

class MovieController extends Controller
{
    public function getMovie($id)
    {
        try
        {
            $movie = Tmdb::getMoviesApi()->getMovie($id, ['language' => 'pl']);
            $credits = Tmdb::getMoviesApi()->getCredits($id);
            if( Auth::user() )
            {
                $favourite = Favourite::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
                $watched = Watched::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
                $watchlist = Watchlist::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
            }
            else
            {
                $favourite = null;
                $watchlist = null;
                $watched = null;
            }

            \Carbon\Carbon::setLocale('pl');
            $reviews = Review::where('movie_id', '=', $id)->get();

            if(count($reviews) > 0)
            {
                $ratingSum = null;
                $ratingPeople = null;

                foreach($reviews as $review)
                {
                    $ratingPeople++;
                    $ratingSum += $review['rating'];
                }

                $ratingAverage = $ratingSum / $ratingPeople;
                $ratingAverage = round($ratingAverage, 2);
            }

            return view('movie', compact(
                'movie',
                'credits',
                'favourite',
                'watched',
                'watchlist',
                'reviews',
                'ratingAverage'
            ));
        }

        catch(TmdbApiException $e)
        {
            if (TmdbApiException::STATUS_RESOURCE_NOT_FOUND == $e->getCode())
            {
                notify()->flash('Nie znaleziono filmu', 'error', ['timer' => 1500]);
                return redirect()->back();

            }
        }
    }

    public function userOptions(Request $request)
    {
        if (Auth::user())
        {
            switch ($request['options'])
            {
                case 'favourite':
                    $favourite = new Favourite();
                    $favourite->user_id = Auth::user()->id;
                    $favourite->movie_id = $request['movie_id'];
                    $favourite->save();
                    notify()->flash('Film dodany do ulubionych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'watched':
                    $watched = new Watched();
                    $watched->user_id = Auth::user()->id;
                    $watched->movie_id = $request['movie_id'];
                    $watched->save();
                    notify()->flash('Film dodany do obejrzanych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'watchlist':
                    $watchlist = new Watchlist();
                    $watchlist->user_id = Auth::user()->id;
                    $watchlist->movie_id = $request['movie_id'];
                    $watchlist->save();
                    notify()->flash('Film dodany do obejrzenia', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteFavourite':
                    $favourite = Favourite::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $favourite->delete();
                    notify()->flash('Film usunięty z ulubionych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteWatched':
                    $watched = Watched::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $watched->delete();
                    notify()->flash('Film usunięty z obejrzanych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteWatchlist':
                    $watchlist = Watchlist::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $watchlist->delete();
                    notify()->flash('Film usunięty z listy do obejrzenia', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                default:
                    notify()->flash('Nieprawidłowa opcja', 'error', ['timer' => 1500]);
                    return redirect()->back();
            }
        }

        else
        {
            switch ($request['options'])
            {
                case 'favourite':
                    notify()->flash('Musisz się zalogować by dodać film do ulubionych', 'error', ['timer' => 1500]);
                    return redirect()->back();
                    break;
                case 'watched':
                    notify()->flash('Musisz się zalogować by dodać film do obejrzanych', 'error', ['timer' => 1500]);
                    return redirect()->back();
                    break;
                case 'watchlist':
                    notify()->flash('Musisz się zalogować by dodać film do obejrzenia', 'error', ['timer' => 1500]);
                    return redirect()->back();
                    break;
                default:
                    notify()->flash('Nieprawidłowa opcja', 'error', ['timer' => 1500]);
                    return redirect()->back();
            }
        }
    }

    public function getCast($id)
    {
        try
        {
            $credits = Tmdb::getMoviesApi()->getCredits($id);
            $cast = $credits['cast'];
            $crew = $credits['crew'];

            $movie = Tmdb::getMoviesApi()->getMovie($id, ['language' => 'pl']);
            $title = $movie['title'];
            $poster = $movie['poster_path'];
            $moviePath = $id;


            return view('cast', compact(
                'cast',
                'crew',
                'title',
                'poster',
                'moviePath'
            ));
        }
        catch(TmdbApiException $e)
        {
            if (TmdbApiException::STATUS_RESOURCE_NOT_FOUND == $e->getCode())
            {
                notify()->flash('Nie znaleziono aktora', 'error', ['timer' => 1500]);
                return redirect()->back();

            }
        }
    }

    public function getMovieDirectory()
    {
        $selected = 100;
        $genresList = Tmdb::getGenresApi()->getMovieGenres(['language' => 'pl']);

        $genres = [];

        $genres[100] = 'Wszystkie';
        foreach ($genresList['genres'] as $genre) {
            $genres[$genre['id']] = $genre['name'];
        }

        $mostPopularMovies = Tmdb::getMoviesApi()->getPopular(['language' => 'pl', 'page' => '1']);
        $mostPopularMovies = $mostPopularMovies['results'];

        $topRatedMovies = Tmdb::getMoviesApi()->getTopRated([['language' => 'pl', 'page' => '1']]);
        $topRatedMovies = $topRatedMovies['results'];

        return view('movie_directory', compact(
            'mostPopularMovies',
            'topRatedMovies',
            'genres',
            'selected'
        ));

    }

    public function getPostMovieDirectory(Request $request)
    {
        $routeName = \Route::current()->getname();
        if($routeName == 'movies_genre')
        {
            $id = substr(url()->current(), -2);
            $request['genre'] = $id;
        }
        if($request['genre'] == 100)
        {
            return redirect()->route('movies');
        }
        $selected = $request['genre'];
        $genresList = Tmdb::getGenresApi()->getMovieGenres(['language' => 'pl']);

        $genres = [];

        $genres[100] = 'Wszystkie';
        foreach ($genresList['genres'] as $genre) {
            $genres[$genre['id']] = $genre['name'];
        }
        $mostPopularMovies = Tmdb::getDiscoverApi()->discoverMovies(['language' => 'pl', 'page' => '1', 'with_genres' => $selected, 'sort_by' => 'popularity.desc']);
        $mostPopularMovies = $mostPopularMovies['results'];

        $topRatedMovies = Tmdb::getDiscoverApi()->discoverMovies(['language' => 'pl', 'page' => '1', 'with_genres' => $selected, 'sort_by' => 'vote_average.desc', 'vote_count.gte' => 50]);
        $topRatedMovies = $topRatedMovies['results'];

        return view('movie_directory', compact(
            'mostPopularMovies',
            'topRatedMovies',
            'genres',
            'selected'
        ));

    }


    public function getReview($id)
    {
        $movie = Tmdb::getMoviesApi()->getMovie($id, ['language' => 'pl']);

        return view('review_form', compact (
            'id',
            'movie'
        ));
    }

    public function postReview(Request $request, \App\Http\Requests\Review $validation )
    {
        $review = new Review();

        $review->user_id = $request['user_id'];
        $review->movie_id = $request['movie_id'];
        $review->title = $request['title'];
        $review->body = $request['body'];
        $review->rating = $request['rating'];

        $review->save();

        notify()->flash('Recenzja dodana', 'success', ['timer' => 1500]);
        return redirect()->route('getMovie', $request['movie_id']);

    }
}
