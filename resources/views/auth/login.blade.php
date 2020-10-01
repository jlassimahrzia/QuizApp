<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{asset('login_registrer\colorlib-regform-7/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('login_registrer\colorlib-regform-7/css/style.css')}}">
</head>

<body>
    {{--
        <div class="main">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    --}}
    <!-- Sing in  Form -->
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('login_registrer\colorlib-regform-7/images/signin-image.jpg')}}"
                                alt="sing up image"></figure>
                        @if (Route::has('password.request'))
                        <a class="signup-image-link" href="{{ route('password.request') }}">
                            Mot de passe oublié
                        </a>
                        @endif
                        {{-- <a href="register.php" class="signup-image-link">Créer un compte</a> --}}
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Connexion</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{-- <form method="POST" class="register-form" id="login-form"> --}}
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Votre login" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="your_name" id="your_name" placeholder="Votre login" />
                    </div> --}}
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password"
                                    class="@error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="Mot de passe">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="your_pass" id="your_pass" placeholder="Mot de passe" />
                    </div> --}}
                            {{-- <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Enregistrer
                            </label>
                        </div> --}}
                            <div class="form-group form-button">
                                {{-- <button type="submit" class="form-submit">
                                Connexion
                            </button> --}}
                                <input type="submit" class="form-submit" value="Connexion" />
                                {{-- <input type="submit" name="signin" id="signin" class="form-submit" value="Connexion" /> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- JS -->
    <script src="{{asset('login_registrer\colorlib-regform-7/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('login_registrer\colorlib-regform-7/js/main.js')}}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
