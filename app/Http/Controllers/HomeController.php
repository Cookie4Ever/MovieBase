<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tmdb\Laravel\Facades\Tmdb;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMovie()
    {
        $show = Tmdb::getTvApi()->getTvshow('1402');
        dd($show);
    }

    public function index()
    {
        $mostPopularMovies = Tmdb::getMoviesApi()->getPopular(['language' => 'pl', 'page' => '1']);
        $mostPopularTvShows = Tmdb::getTvApi()->getPopular(['language' => 'pl', 'page' => '1']);
       // dd($mostPopularMovies);
        return view('home', compact(
            'mostPopularMovies',
            'mostPopularTvShows'

        ));
    }


}
