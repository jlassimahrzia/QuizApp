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
            <h2 class="text-center mb-30">
                Réinitialiser le mot de passe
            </h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <p>Adresse Email</p>
                <div class="input-group custom input-group-lg">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <p>Entrez votre nouveau mot de passe, confirmez et soumettez</p>
                <div class="input-group custom input-group-lg">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Nouveau Mot de passe">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="input-group custom input-group-lg">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirmer le Nouveau Mot de passe">
                    <div class="input-group-append custom">
                        <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <!--
								use code for form submit
								<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
							-->
                            <button type="submit" class="btn btn-primary btn-lg btn-block" href="index.php">
                               Soumettre
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
