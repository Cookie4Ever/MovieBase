<div class="masthead clearfix">
    <div class="inner">
        <h3 class="masthead-brand">MovieBase</h3>
        <nav>
            <ul class="nav masthead-nav">
                <li @if($currentRoute == 'home') class="active"@endif><a href="{{ route('home') }}">Strona główna</a></li>
                <li @if($currentRoute == 'getMovie' || $currentRoute == 'movies' || $currentRoute == 'get_cast' || $currentRoute == 'movies_genre') class="active"@endif><a href="{{ route('movies') }}">Filmy</a></li>
                <li @if($currentRoute == 'get_tv_show' || $currentRoute == 'tv_shows' || $currentRoute == 'get_tv_cast' || $currentRoute == 'tv_genre') class="active"@endif><a href="{{ route('tv_shows') }}">Seriale</a></li>
                @if( !$currentUser )
                    <li><a href="{{ route('login') }}">Zaloguj się</a></li>
                    <li><a href="{{ route('register') }}">Zarejestruj się</a></li>
                @else

                        <li>
                            <div class="dropdown-user">
                            <li @if($currentRoute == 'user_movies') class="active"@endif>
                                <a id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-user">
                                        {{ $currentUser->name }}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user" aria-labelledby="dLabel">
                                        <li><a href="{{ Route('user_movies') }}#favourite">Ulubione</a></li>
                                        <li><a href="{{ Route('user_movies') }}#watched">Obejrzane</a></li>
                                        <li><a href="{{ Route('user_movies') }}#watchlist">Do obejrzenia</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                Wyloguj się
                                            </a>
                                        </li>
                                    </ul>
                            </li>
                            </div>
                        </li>

                    <?PHP
                    echo Form::open(['route' => 'logout', 'id' => 'logout-form']);
                    echo Form::close();
                    ?>
                @endif
            </ul>
        </nav>
    </div>
</div>

