<?php

Auth::routes();

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('movie', [
    'as' => 'movies',
    'uses' => 'MovieController@getMovieDirectory'
]);

Route::get('movie/genre/{id}', [
    'as' => 'movies_genre',
    'uses' => 'MovieController@getPostMovieDirectory'
]);

Route::post('movie', [
    'as' => 'movies',
    'uses' => 'MovieController@getPostMovieDirectory'
]);

Route::get('movie/{id}', [
    'as' => 'getMovie',
    'uses' => 'MovieController@getMovie'
]);

Route::post('movie/{id}', [
    'as' => 'getMovie',
    'uses' => 'MovieController@userOptions'
]);

Route::get('movie/{id}/cast', [
    'as' => 'get_cast',
    'uses' => 'MovieController@getCast',
]);

Route::get('tv_show/{id}', [
    'as' => 'get_tv_show',
    'uses' => 'TvShowController@getTvShow'
]);

Route::post('tv_show/{id}', [
    'as' => 'get_tv_show',
    'uses' => 'TvShowController@userOptions'
]);

Route::get('tv_show/{id}/cast', [
    'as' => 'get_tv_cast',
    'uses' => 'TvShowController@getCast',
]);

Route::get('user/user_movies', [
    'as' => 'user_movies',
    'uses' => 'UserController@userMovies',
    'middleware' => 'auth'
]);

Route::get('tv_show', [
    'as' => 'tv_shows',
    'uses' => 'TvShowController@getTvShowDirectory'
]);

Route::post('tv_show', [
    'as' => 'tv_shows',
    'uses' => 'TvShowController@getPostTvShowDirectory'
]);

Route::get('tv_show/genre/{id}', [
    'as' => 'tv_genre',
    'uses' => 'TvShowController@getPostTvShowDirectory'
]);

Route::get('actor/{id}', [
    'as' => 'get_person',
    'uses' => 'PersonController@getPerson'
]);

Route::get('movie/{id}/post_review', [
    'as' => 'get_review',
    'uses' => 'MovieController@getReview',
    'middleware' => 'auth'
]);

Route::post('movie/{id}/post_review', [
    'as' => 'post_review',
    'uses' => 'MovieController@postReview',
    'middleware' => 'auth'
]);

Route::get('tv_show/{id}/post_review', [
    'as' => 'get_tv_review',
    'uses' => 'TvShowController@getReview',
    'middleware' => 'auth'
]);

Route::post('tv_show/{id}/post_review', [
    'as' => 'post_tv_review',
    'uses' => 'TvShowController@postReview',
    'middleware' => 'auth'
]);


