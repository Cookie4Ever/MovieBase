@extends('layouts.master.master')

@section('page-content')
    <h2 class="text-left h-tag-padding">Najczęściej oglądane filmy</h2>
    <div class="slick-carousel">
        @foreach($mostPopularMovies['results'] as $movie)

            <div>

                    <a href="{{ Route('getMovie', $movie['id']) }}" data-toggle="movie-overview" title="{{ $movie['overview'] }}" data-placement="bottom">
                        <img src="https://image.tmdb.org/t/p/w160{{ $movie['poster_path'] }}" class="img-responsive" /> </a>

            </div>

        @endforeach
    </div>

    <h2 class="text-left h-tag-padding">Najczęściej oglądane seriale</h2>
    <div class="slick-carousel">
        @foreach($mostPopularTvShows['results'] as $movie)

            <div>

                <a href="{{ Route('get_tv_show', $movie['id']) }}" data-toggle="movie-overview" title="{{ $movie['overview'] }}" data-placement="bottom">
                    <img src="https://image.tmdb.org/t/p/w160{{ $movie['poster_path'] }}" class="img-responsive" /> </a>

            </div>

        @endforeach
    </div>



@endsection

