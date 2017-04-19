<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb;
use Illuminate\Support\Facades\Auth;
use App\TvFavourite;
use App\TvWatched;
use App\TvWatchlist;
use App\TvReview;
use App\User;
use Tmdb\Exception\TmdbApiException;

class TvShowController extends Controller
{

    public function getTvShow($id)
    {
        try {
            $movie = Tmdb::getTvApi()->getTvshow($id, ['language' => 'pl']);
            //dd($movie);
            $credits = Tmdb::getTvApi()->getCredits($id);
            if (Auth::user()) {
                $favourite = TvFavourite::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
                $watched = TvWatched::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
                $watchlist = TvWatchlist::where(['user_id' => Auth::user()->id, 'movie_id' => $id])->first();
            } else {
                $favourite = null;
                $watchlist = null;
                $watched = null;
            }

            \Carbon\Carbon::setLocale('pl');
            $reviews = TvReview::where('movie_id', '=', $id)->get();

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

            return view('tv_show', compact(
                'movie',
                'credits',
                'favourite',
                'watched',
                'watchlist',
                'ratingAverage',
                'reviews'
            ));
        }

        catch (TmdbApiException $e) {
            if (TmdbApiException::STATUS_RESOURCE_NOT_FOUND == $e->getCode()) {
                notify()->flash('Nie znaleziono serialu', 'error', ['timer' => 1500]);
                return redirect()->back();

            }
        }
    }

    public function userOptions(Request $request)
    {
        if (Auth::user()) {
            switch ($request['options']) {
                case 'favourite':
                    $favourite = new TvFavourite();
                    $favourite->user_id = Auth::user()->id;
                    $favourite->movie_id = $request['movie_id'];
                    $favourite->save();
                    notify()->flash('Serial dodany do ulubionych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'watched':
                    $watched = new TvWatched();
                    $watched->user_id = Auth::user()->id;
                    $watched->movie_id = $request['movie_id'];
                    $watched->save();
                    notify()->flash('Serial dodany do obejrzanych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'watchlist':
                    $watchlist = new TvWatchlist();
                    $watchlist->user_id = Auth::user()->id;
                    $watchlist->movie_id = $request['movie_id'];
                    $watchlist->save();
                    notify()->flash('Serial dodany do obejrzenia', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteFavourite':
                    $favourite = TvFavourite::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $favourite->delete();
                    notify()->flash('Serial usunięty z ulubionych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteWatched':
                    $watched = TvWatched::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $watched->delete();
                    notify()->flash('Serial usunięty z obejrzanych', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                case 'deleteWatchlist':
                    $watchlist = TvWatchlist::where(['user_id' => Auth::user()->id, 'movie_id' => $request['movie_id']])->first();
                    $watchlist->delete();
                    notify()->flash('Serial usunięty z listy do obejrzenia', 'success', ['timer' => 1500]);
                    return redirect()->back();
                    break;

                default:
                    notify()->flash('Nieprawidłowa opcja', 'error', ['timer' => 1500]);
                    return redirect()->back();
            }
        } else {
            switch ($request['options']) {
                case 'favourite':
                    notify()->flash('Musisz się zalogować by dodać serial do ulubionych', 'error', ['timer' => 1500]);
                    return redirect()->back();
                    break;
                case 'watched':
                    notify()->flash('Musisz się zalogować by dodać serial do obejrzanych', 'error', ['timer' => 1500]);
                    return redirect()->back();
                    break;
                case 'watchlist':
                    notify()->flash('Musisz się zalogować by dodać serial do obejrzenia', 'error', ['timer' => 1500]);
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
        $credits = Tmdb::getTvApi()->getCredits($id);
        $cast = $credits['cast'];
        $crew = $credits['crew'];

        $movie = Tmdb::getTvApi()->getTvshow($id, ['language' => 'pl']);
        $title = $movie['name'];
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

    public function getTvShowDirectory()
    {
        $selected = 100;
        $genresList = Tmdb::getGenresApi()->getTvGenres(['language' => 'pl']);

        $genres = [];

        $genres[100] = 'Wszystkie';
        foreach ($genresList['genres'] as $genre)
        {
            $genres[$genre['id']] = $genre['name'];
        }

        $mostPopularMovies = Tmdb::getTvApi()->getPopular(['language' => 'pl', 'page' => '1']);
        $mostPopularMovies = $mostPopularMovies['results'];

        $topRatedMovies = Tmdb::getTvApi()->getTopRated([['language' => 'pl', 'page' => '1']]);
        $topRatedMovies = $topRatedMovies['results'];


        return view('tv_show_directory', compact(
            'mostPopularMovies',
            'topRatedMovies',
            'genres',
            'selected'
        ));
    }


    public function getPostTvShowDirectory(Request $request)
    {
        $routeName = \Route::current()->getname();
        if($routeName == 'tv_genre')
        {
            $id = substr(url()->current(), -2);
            $request['genre'] = $id;
        }
        if($request['genre'] == 100)
        {
            return redirect()->route('tv_shows');
        }
        $selected = $request['genre'];
        $genresList = Tmdb::getGenresApi()->getTvGenres(['language' => 'pl']);

        $genres = [];
        $genres[100] = 'Wszystkie';

        foreach ($genresList['genres'] as $genre)
        {
            $genres[$genre['id']] = $genre['name'];
        }

        $mostPopularMovies = Tmdb::getDiscoverApi()->discoverTv(['language' => 'pl', 'page' => '1', 'with_genres' => $selected, 'sort_by' => 'popularity.desc']);
        $mostPopularMovies = $mostPopularMovies['results'];

        $topRatedMovies = Tmdb::getDiscoverApi()->discoverTv(['language' => 'pl', 'page' => '1', 'with_genres' => $selected, 'sort_by' => 'vote_average.desc', 'vote_count.gte' => 50]);
        $topRatedMovies = $topRatedMovies['results'];

        return view('tv_show_directory', compact(
            'mostPopularMovies',
            'topRatedMovies',
            'genres',
            'selected'
        ));

    }

    public function getReview($id)
    {
        $movie = Tmdb::getTvApi()->getTvshow($id, ['language' => 'pl']);

        return view('tv_review_form', compact (
            'id',
            'movie'
        ));
    }

    public function postReview(Request $request, \App\Http\Requests\Review $validation )
    {
        $review = new TvReview();

        $review->user_id = $request['user_id'];
        $review->movie_id = $request['movie_id'];
        $review->title = $request['title'];
        $review->body = $request['body'];
        $review->rating = $request['rating'];

        $review->save();

        notify()->flash('Recenzja dodana', 'success', ['timer' => 1500]);
        return redirect()->route('get_tv_show', $request['movie_id']);

    }
}
