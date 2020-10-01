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
    <style>
        #im {
            width: 200px;
            position: absolute;
            margin-top: -25px;
            margin-left: 0;
        }

        #d {
            width: 100%;
            background: #ffffff;
            /* padding: 10px 20px; */
            -webkit-box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.4);
            box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.4);
            position: fixed;
        }

        .notif {
            width: 100%;
            min-width: 300px;
            float: left;
        }
    </style>
    @yield('head')
</head>

<body>
    <!-- Debut Header -->

    <div class="pre-loader"></div>
    <div class="header clearfix">
        <div id="d">
            {{-- <div class="brand-logo" >
                <a href="index.php">
                    <img src="{{ asset('vendors/images/deskapp-logo.png') }}" alt="">
            </a>
        </div> --}}
        <div class="brand-logo">
            <a href="/matiere_etudiant" id="l">
                <img src="{{ asset('vendors/images/quiz.png') }}" alt="" id="im"
                style="opacity='100%'">
            </a>
        </div>

    </div>
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                <span class="user-icon"> <img src="/storage/image/{{Auth::user()->photo}}" alt=""
                    style="border-radius:50%"></span>
                <span class="user-name">{{ Auth::user()->nom }}
                    {{ Auth::user()->prenom }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/profile_etudiant"><i class="fa fa-user-md" aria-hidden="true"></i>
                    Profile</a>{{--
						<a class="dropdown-item" href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a>
						<a class="dropdown-item" href="faq.php"><i class="fa fa-question" aria-hidden="true"></i> Help</a> --}}
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="dropdown-item">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>

    </div>
    {{-- 	<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="{{ asset('vendors/images/img.jpg') }}" alt="">
    <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
    </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    <li>
        <a href="#">
            <img src="{{ asset('vendors/images/img.jpg') }}" alt="">
            <h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
        </a>
    </li>
    </ul>
    </div>
    </div>
    </div>
    </div> --}}

    <!-- Fin Header -->
    <!-- Debut Sidebar -->
    {{-- <div class="left-side-bar">
        <div class="brand-logo left-side-bar">
            <a href="index.php">
                <img src="{{ asset('vendors/images/deskapp-logo.png') }}" alt="">
    </a>
    </div>
    </div> --}}
    <!-- Fin Sidebar -->

    <div class="container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                @yield('content')
                <br><br><br>
                <!-- Debut Footer -->
                <div class="footer-wrap bg-white pd-20 mb-20 border-radius-5 box-shadow">
                    App Quiz - Application de quiz
                </div>
                <!-- Fin Sidebar -->
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('vendors/scripts/script.js') }}"></script>
    @yield('script')
</body>

</html>
