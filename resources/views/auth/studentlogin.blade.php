<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>McU Clinic | Student</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;700&display=swap" rel="stylesheet">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />

    <link rel="stylesheet" href="{{asset('css/main.css')}}" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>

</head>
<body>
<div style="margin: 100px 0px">
    <div class="uk-container" style="max-width: 600px">
        <div class="uk-card uk-card-default uk-card-body">
            <div style="text-align: center"><img src="{{asset('img/logo1.png')}}" alt="" style="width: 300px"></div>
            <h3 class="uk-card-title">Student Login</h3>
            <form method="POST" action="{{ url('/student/login') }}">
                @csrf

                @if ( Session::has('error') )
                <div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">{{ __('E-Mail Address') }}</label>
                    <div class="uk-form-controls">
                        <input class="uk-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="email" type="email" >
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">{{ __('Password') }}</label>
                    <div class="uk-form-controls">
                        <input class="uk-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" name="password" required id="password" type="password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="uk-button uk-button-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
                <br>
                <a href="/student/register">Don't have an account yet, Register here</a>
            </form>
        </div>
    </div>
</div>
</body>
