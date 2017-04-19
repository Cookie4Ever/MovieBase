
@extends('layouts.master.master')

@section('page-content')
    @include('layouts.partials.form_errors')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <img src="https://image.tmdb.org/t/p/w320{{ $movie['poster_path']  }}" class="img-responsive img-rounded img-responsive-movie" />
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h3>Napisz recenzje</h3>
            <div class="row btn-margin">
                {{ Form::open(['route' => ['post_tv_review', $movie['id']]]) }}

                <p>{{ Form::label('title', 'Tytuł') }}</p>
                <p>{{ Form::text('title', '', ['class' => 'form-control text-center']) }}</p>

                <p>{{ Form::label('body', 'Treść') }}</p>
                <p>{{ Form::textarea('body', '', ['class' => 'form-control']) }}</p>

                <span class="glyphicon glyphicon-star btn-margin" aria-hidden="true"></span>
                {{ Form::label('rating', 'Ocena') }}
                {{Form::select('rating', [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10'

                ], ['class' => 'form-control select-color'])}}

                {{ Form::hidden('movie_id', $id) }}
                {{ Form::hidden('user_id', $currentUser->id) }}
                <br/>
                <button class="btn btn-success btn-block btn-margin" type="submit">Dodaj recenzje!</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>



@endsection