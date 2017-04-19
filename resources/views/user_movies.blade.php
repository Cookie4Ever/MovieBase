
@extends('layouts.master.master')

@section('page-content')
    <div align="center">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="#favourite" aria-controls="favourite" role="tab" data-toggle="tab">Ulubione({{ count($favouriteIdArray) }})</a></li>
            <li role="presentation"><a href="#watched" aria-controls="watched" role="tab" data-toggle="tab">Obejrzane({{ count($watchedIdArray) }})</a></li>
            <li role="presentation"><a href="#watchlist" aria-controls="watchlist" role="tab" data-toggle="tab">Do obejrzenia({{ count($watchlistIdArray) }})</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content ">
            <div role="tabpanel" class="tab-pane fade" id="favourite">
                <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Filmy użytkownika</h3>
                @for($i = 0; $i < count($favouriteIdArray); $i++)

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 genres">
                        <a href="{{ route('getMovie', $favouriteIdArray[$i]) }}">
                            <img src="https://image.tmdb.org/t/p/w160{{ $favouritePosterArray[$i] }}" class="img-responsive img-rounded" />
                            <h4><b>{{ $favouriteNameArray[$i] }}</b></h4>
                        </a>
                    </div>

                @endfor

                @if(count($favouriteIdArray) == 0) Brak filmów @endif


                <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Seriale użytkownika</h3>
                @for($i = 0; $i < count($tvFavouriteIdArray); $i++)

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 genres">
                        <a href="{{ route('get_tv_show', $tvFavouriteIdArray[$i]) }}">
                            <img src="https://image.tmdb.org/t/p/w160{{ $tvFavouritePosterArray[$i] }}" class="img-responsive img-rounded" />
                            <h4><b>{{ $tvFavouriteNameArray[$i] }}</b></h4>
                        </a>
                    </div>

                @endfor
                @if(count($tvFavouriteIdArray) == 0)<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Brak seriali </div>@endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="watched">
                <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Filmy użytkownika</h3>
                @for($i = 0; $i < count($watchedIdArray); $i++)

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 genres">
                        <a href="{{ route('getMovie', $watchedIdArray[$i]) }}">
                            <img src="https://image.tmdb.org/t/p/w160{{ $watchedPosterArray[$i] }}" class="img-responsive img-rounded" />
                            <h4><b>{{ $watchedNameArray[$i] }}</b></h4>
                        </a>
                    </div>

                @endfor
                @if(count($watchedIdArray) == 0) Brak filmów @endif


                    <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Seriale użytkownika</h3>
                    @for($i = 0; $i < count($tvWatchedIdArray); $i++)

                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 genres">
                            <a href="{{ route('get_tv_show', $tvWatchedIdArray[$i]) }}">
                                <img src="https://image.tmdb.org/t/p/w160{{ $tvWatchedPosterArray[$i] }}" class="img-responsive img-rounded" />
                                <h4><b>{{ $tvWatchedNameArray[$i] }}</b></h4>
                            </a>
                        </div>

                    @endfor
                    @if(count($tvWatchedIdArray) == 0)<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Brak seriali </div>@endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="watchlist">
                <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Filmy użytkownika</h3>
                @for($i = 0; $i < count($watchlistIdArray); $i++)

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <a href="{{ route('getMovie', $watchlistIdArray[$i]) }}">
                            <img src="https://image.tmdb.org/t/p/w160{{ $watchlistPosterArray[$i] }}" class="img-responsive img-rounded" />
                            <b>{{ $watchlistNameArray[$i] }}</b>
                        </a>
                    </div>

                @endfor
                @if(count($watchlistIdArray) == 0) Brak filmów @endif


                    <h3 class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="title-spacer">Seriale użytkownika</h3>
                    @for($i = 0; $i < count($tvWatchlistIdArray); $i++)

                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 genres">
                            <a href="{{ route('get_tv_show', $tvWatchlistIdArray[$i]) }}">
                                <img src="https://image.tmdb.org/t/p/w160{{ $tvWatchlistPosterArray[$i] }}" class="img-responsive img-rounded" />
                                <h4><b>{{ $tvWatchlistNameArray[$i] }}</b></h4>
                            </a>
                        </div>

                    @endfor
                    @if(count($tvWatchlistIdArray) == 0)<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> Brak seriali </div> @endif
            </div>
        </div>

    </div>


@endsection