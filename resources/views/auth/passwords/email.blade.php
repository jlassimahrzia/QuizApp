<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Réinitialiser le mot de passe</title>

    <!-- Site favicon -->
    <!-- <link rel="shortcut icon" href="images/favicon.ico"> -->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}">
</head>

<body>
    <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
        <div class="login-box bg-white box-shadow pd-30 border-radius-5">
            <img src="{{asset('vendors/images/login-img.png')}}" alt="login" class="login-img">
            <h2 class="text-center mb-30">Mot de passe oublié</h2>
             @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                <p>Saisissez votre adresse email pour réinitialisez votre mot de passe</p>
                <div class="input-group custom input-group-lg">
                    <input id="email" type="email" class="form-control @error('email') is-invalid
                                @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<!--
								use code for form submit
								<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
							-->
							<button type="submit" class="btn btn-primary btn-lg btn-block" >Soumettre</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password"><a href="/" class="btn btn-outline-primary btn-lg btn-block">Connexion</a></div>
					</div>
				</div>
            </form>
        </div>
    </div>
</body>
