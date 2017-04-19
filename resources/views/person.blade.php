@extends('layouts.master.master')

@section('page-content')

    <div class="row h-tag-padding">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <img src="https://image.tmdb.org/t/p/w640/{{ $person->getProfileImage()->getFilePath()  }}" class="img-responsive img-rounded img-responsive-movie" />
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h1>{{ $person->getName()}}</h1>
            <br/>
            <h4>Data urodzin: {{ $person->getBirthday()->format('d/m/Y')}}</h4>
            <h4>Miejsce urodzenia: {{ $person->getPlaceOfBirth() }}</h4>
            @if($person->getDeathday() == true)<h4>Data śmierci: {{ $person->getDeathday()->format('d/m/Y') }}</h4>@endif
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 carousel-person">
            <div class="slick-carousel-person">
                @foreach($images as $image)

                    <div>

                            <img src="https://image.tmdb.org/t/p/w640{{ $image->getFilePath() }}" class="img-responsive img-rounded person-images" />

                    </div>

                @endforeach
            </div>
        </div>
    </div>
    <div class="row h-tag-padding">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {!! nl2br($biography) !!}
        </div>
    </div>
<h2>Filmografia</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table">
                @foreach($movieArray as $movie)
                       <tr>
                            <td>
                                <a href="{{ route('getMovie', $movie['id']) }}"><img src="https://image.tmdb.org/t/p/w160/{{ $movie['poster']  }}" class="img-responsive img-rounded" /></a>
                            </td>
                           <td class="row-actors">
                               <a href="{{ route('getMovie', $movie['id']) }}">{{ $movie['title'] }} ({{ $movie['date'] }})</a>
                           </td>
                            <td class="row-actors">
                                jako: {{ $movie['character'] }}
                            </td>
                       </tr>
                @endforeach
                <tr><td colspan="3"><h2 class="back-button">Seriale</h2></td></tr>
                    @foreach($tvShowArray as $movie)
                        <tr>
                            <td>
                                <a href="{{ route('get_tv_show', $movie['id']) }}"><img src="https://image.tmdb.org/t/p/w160/{{ $movie['poster']  }}" class="img-responsive img-rounded" /></a>
                            </td>
                            <td class="row-actors">
                                <a href="{{ route('get_tv_show', $movie['id']) }}">{{ $movie['title'] }} ({{ $movie['date'] }})</a>
                            </td>
                            <td class="row-actors">
                                jako: {{ $movie['character'] }}
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>



@endsection

