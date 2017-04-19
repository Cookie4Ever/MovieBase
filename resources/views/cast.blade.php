
@extends('layouts.master.master')

@section('page-content')
    <div>
        <h2>Obsada i załoga</h2>
        <div class="text-left back-button">
            @if($currentRoute == 'get_cast')<a href="{{route('getMovie', $moviePath)}}" role="button" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Wróc do filmu</a>@endif
                @if($currentRoute == 'get_tv_cast')<a href="{{route('get_tv_show', $moviePath)}}" role="button" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Wróc do serialu</a>@endif
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs credit-page" role="tablist">
            <li role="presentation" class="active"><a href="#cast" aria-controls="cast" role="tab" data-toggle="tab">Obsada({{ count($cast) }})</a></li>
            <li role="presentation"><a href="#crew" aria-controls="crew" role="tab" data-toggle="tab">Załoga({{ count($crew) }})</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content ">
            <div role="tabpanel" class="tab-pane fade in active" id="cast">
                <table class="table">
                    @foreach($cast as $person)
                       <tr>
                           @if($person['profile_path'])
                               <td><a href="{{ route('get_person', $person['id']) }}"><img src="https://image.tmdb.org/t/p/w132_and_h132_bestv2{{ $person['profile_path'] }}" class="img-responsive img-rounded"></a></td>
                           @else
                               <td><img src="/resources/images/unknown.png" class="img-responsive img-rounded"></td>
                           @endif
                           <td class="row-actors"><h4><b>{{$person['character']}}</b></h4></td>
                           <td class="row-actors"><a href="{{ route('get_person', $person['id']) }}">{{$person['name']}}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="crew">
                <table class="table">
                    @foreach($crew as $person)
                        <tr>
                            @if($person['profile_path'])
                                <td><a href="#"><img src="https://image.tmdb.org/t/p/w132_and_h132_bestv2{{ $person['profile_path'] }}" class="img-responsive img-rounded"></a></td>
                            @else
                                <td><img src="/resources/images/unknown.png" class="img-responsive img-rounded"></td>
                            @endif
                            <td class="row-actors"><h4><b>{{$person['job']}}</b></h4></td>
                            <td class="row-actors"><a href="#">{{$person['name']}}</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

@endsection