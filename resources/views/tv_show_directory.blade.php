@extends('layouts.master.master')

@section('page-content')

    <ul class="nav nav-tabs credit-page" role="tablist">
        <li role="presentation" class="active"><a href="#mostPopular" aria-controls="mostPopular" role="tab" data-toggle="tab">Najpopularniejsze</a></li>
        <li role="presentation"><a href="#topRated" aria-controls="topRated" role="tab" data-toggle="tab">Najwyżej oceniane</a></li>
    </ul>


    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="mostPopular">
            <div class="text-right">
                {{ Form::open(['route' => 'tv_shows']) }}
                <h3 class="inline-block"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Gatunek </h3>{{ Form::select('genre', $genres, $selected, ['id' => 'genreee', 'class' => 'selectpicker genres']) }}
                {{ Form::hidden('hash', '') }}
                {{ Form::close() }}
            </div>
            <table class="table">
                @foreach($mostPopularMovies as $movie)
                    <tr>

                        <td class="row-actors">
                            <a href="{{ route('get_tv_show', $movie['id']) }}">
                                <img src="https://image.tmdb.org/t/p/w160{{ $movie['poster_path'] }}" class="img-responsive img-rounded" />
                            </a>
                        </td>

                        <td class="row-actors">
                            <a href="{{ route('get_tv_show', $movie['id']) }}">
                                <h2 id="character">{{ $movie['name'] }} ({{ strstr($movie['first_air_date'], '-', true) }})</h2>
                            </a>
                            <h4>{{ $movie['original_name'] }}</h4>

                        </td>

                        <td class="row-actors">
                            <h1><span class="glyphicon glyphicon-star" aria-hidden="true"></span></h1>
                            <h2>{{ $movie['vote_average'] }}</h2>
                            <h4>głosów {{ $movie['vote_count'] }}</h4>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="topRated">
            <div class="text-right">
                {{ Form::open(['route' => 'tv_shows']) }}
                <h3 class="inline-block"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Gatunek </h3>{{ Form::select('genre', $genres, $selected, ['id' => 'genree', 'class' => 'selectpicker genres']) }}
                {{ Form::hidden('hash', 'topRated') }}
                {{ Form::close() }}
            </div>
            <table class="table">
                @foreach($topRatedMovies as $movie)
                    <tr>

                        <td>
                            <a href="{{ route('get_tv_show', $movie['id']) }}">
                                <img src="https://image.tmdb.org/t/p/w160{{ $movie['poster_path'] }}" class="img-responsive img-rounded" />
                            </a>
                        </td>

                        <td class="row-actors">
                            <a href="{{ route('get_tv_show', $movie['id']) }}">
                                <h2>{{ $movie['name'] }} ({{ strstr($movie['first_air_date'], '-', true) }})</h2>
                            </a>
                            <h4>{{ $movie['original_name'] }}</h4>

                        </td>

                        <td class="row-actors">
                            <h1><span class="glyphicon glyphicon-star" aria-hidden="true"></span></h1>
                            <h2>{{ $movie['vote_average'] }}</h2>
                            <h4>głosów {{ $movie['vote_count'] }}</h4>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

