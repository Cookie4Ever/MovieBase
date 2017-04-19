@extends('layouts.master.master')

@section('page-content')

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <img src="https://image.tmdb.org/t/p/w320{{ $movie['poster_path']  }}" class="img-responsive img-rounded img-responsive-movie" />
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1>{{ $movie['name'] }} ({{ strstr($movie['first_air_date'], '-', true) }})</h1>
            <?PHP
            if(strlen($movie['overview']) > 740)
            {
                $movie['overview'] = substr($movie['overview'], 0, 738) . "...";
                echo $movie['overview'];
            }
            else
            {
                echo $movie['overview'];
            }
            ?>

            <h3>Gatunki</h3>
            @foreach($movie['genres'] as $genre)
                <a href="{{ route('tv_genre', $genre['id']) }}" class="btn btn-default genres"> {{ $genre['name'] }} </a>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <br/>
            {{ Form::open(['route' => ['get_tv_show', $movie['id']]])  }}
            {{ Form::hidden('movie_id', $movie['id']) }}

            @if($favourite == null)
                {{ Form::button('Dodaj do ulubionych', ['name' => 'options', 'value' => 'favourite', 'class' => 'btn btn-info btn-lg btn-block', 'type' => 'submit']) }}
            @else
                {{ Form::button('Usuń z ulubionych', ['name' => 'options', 'value' => 'deleteFavourite', 'class' => 'btn btn-success btn-lg btn-block', 'type' => 'submit']) }}
            @endif

            @if($watched == null)
                {{ Form::button('Dodaj do obejrzanych', ['name' => 'options', 'value' => 'watched', 'class' => 'btn btn-info btn-lg btn-block', 'type' => 'submit']) }}
            @else
                {{ Form::button('Usuń z obejrzanych', ['name' => 'options', 'value' => 'deleteWatched', 'class' => 'btn btn-success btn-lg btn-block', 'type' => 'submit']) }}
            @endif

            @if($watchlist == null)
                {{ Form::button('Dodaj do obejrzenia', ['name' => 'options', 'value' => 'watchlist', 'class' => 'btn btn-info btn-lg btn-block', 'type' => 'submit']) }}
            @else
                {{ Form::button('Usuń z listy do obejrzenia', ['name' => 'options', 'value' => 'deleteWatchlist', 'class' => 'btn btn-success btn-lg btn-block', 'type' => 'submit']) }}
            @endif
            {{ Form::close() }}
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 id="genre">Obsada</h3>
            @for($i = 0; $i < 4; $i++)
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <a href="{{ route('get_person', $credits['cast'][$i]['id']) }}">
                        <img src="https://image.tmdb.org/t/p/w132_and_h132_bestv2{{ $credits['cast'][$i]['profile_path'] }}" class="img-responsive img-circle img-responsive-movie">
                    </a>
                    <h3 id="character">{{ $credits['cast'][$i]['character'] }}</h3>
                    <a href="{{ route('get_person', $credits['cast'][$i]['id']) }}"> <h5>{{ $credits['cast'][$i]['name'] }}</h5> </a>
                </div>
            @endfor
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a href="{{ route('get_tv_cast', $movie['id']) }}" class="btn btn-default btn-margin" >Pełna obsada i załoga</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>Recenzje użytkowników</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="reviews content">
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td class="row-background no-border">
                            <h3 id="less-margin">{{ $review->title }}
                                <span class="glyphicon glyphicon-star " aria-hidden="true"></span>{{ $review->rating }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="row-background row-padding">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $review->user->name }}
                            <span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $review->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-justify review-body"><span>{{ $review->body }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($reviews) > 0)<div id="pagination"></div>@endif
            @if(count($reviews) == 0)<h4>Brak recenzji, napisz ją pierwszy!</h4>@endif
            <a href="{{ route('get_tv_review', $movie['id']) }}" class="btn btn-success btn-lg btn-block review-button">Napisz recenzje</a>
        </div>
    </div>

@endsection

