@extends('layouts.master.master')


@section('page-content')

    @include('layouts.partials.form_errors')
        <h1>Zaloguj się</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <label for="email" class="col-md-4 control-label">Adres E-Mail</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <br> </br>

            <label for="password" class="col-md-4 control-label">Hasło</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamiętaj mnie
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class=" col-md-12">
                    <button type="submit" class="btn btn-primary">
                        Zaloguj się!
                    </button>
                </div>
            </div>

            <div class="form-group">
                <div class="text-right">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Zapomniałeś hasła?
                    </a>
                </div>
            </div>
        </form>

@endsection
