<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Quiz App</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" href="{{ asset('vendors/images/quiz_mobile.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}">

    @yield('head')
</head>

<body>
    <!-- Debut Header -->
    <div class="pre-loader"></div>
    <div class="header clearfix">
        <div class="header-right">
            <div class="brand-logo">
                @if(Auth::user()->role === '1')
                <a href="/enseignant">
                    <img src="{{ asset('vendors/images/quiz_mobile.png') }}" alt="" class="mobile-logo">
                </a>
                @elseif(Auth::user()->role === '2')
                <a href="/matiere">
                    <img src="{{ asset('vendors/images/quiz_mobile.png') }}" alt="" class="mobile-logo">
                </a>
                @endif
            </div>
            <div class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon"> <img src="/storage/image/{{Auth::user()->photo}}" alt=""
                                style="border-radius:50%"></span>
                        <span class="user-name">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/profile"><i class="fa fa-user-md" aria-hidden="true"></i>
                            Profile</a>{{--
						<a class="dropdown-item" href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
						<a class="dropdown-item" href="faq.php"><i class="fa fa-question" aria-hidden="true"></i> Help</a> --}}
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="dropdown-item">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Header -->
    <!-- Debut Sidebar -->
    <div class="left-side-bar">
        <div class="brand-logo">
            @if(Auth::user()->role === '1')
            <a href="/enseignant">
                <img src="{{ asset('vendors/images/quiz.png') }}" alt="">
            </a>
            @elseif(Auth::user()->role === '2')
            <a href="/matiere">
                <img src="{{ asset('vendors/images/quiz.png') }}" alt="">
            </a>
            @endif
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                @if(Auth::user()->role === '1')
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-address-book-o"></span><span class="mtext">Enseignant</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/enseignant">Liste Des Enseignants</a></li>
                            <li><a href="/enseignant/create">Ajouter Enseignant</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-users"></span><span class="mtext">Classe</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/classe">Liste Des Classes</a></li>
                            <li><a href="/classe/create">Ajouter Classe</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-user-o"></span><span class="mtext">Etudiant</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/etudiant">Liste Des Etudiants</a></li>
                            <li><a href="/etudiant/create">Ajouter Etudiant</a></li>
                        </ul>
                    </li>
                </ul>
                @elseif(Auth::user()->role === '2')
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-book"></span><span class="mtext">Matières</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/matiere">Liste Matières</a></li>
                            <li><a href="/matiere/create">Ajouter Matière</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-list-ol"></span><span class="mtext">Niveaux</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/choisir_matiere">Liste Niveaux</a></li>
                            <li><a href="/niveau/create">Ajouter Niveau</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="fa fa-check-square-o"></span><span class="mtext">QCMs</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="/choisir_matiere_niveau">Liste QCMs</a></li>
                            <li><a href="/qcm/create">Ajouter QCM</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
    <!-- Fin Sidebar -->

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                @yield('content')

                <!-- Debut Footer -->
                <div class="footer-wrap bg-white pd-20 mb-20 border-radius-5 box-shadow">
                    App Quiz - Application de quiz
                </div>
                <!-- Fin Sidebar -->
            </div>
        </div>
        <!-- js -->
        <script src="{{ asset('vendors/scripts/script.js') }}"></script>
        @yield('script')
</body>

</html>
