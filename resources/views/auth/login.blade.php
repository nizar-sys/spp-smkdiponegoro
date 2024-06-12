<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem SPP SMK Diponegoro | Login Petugas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #217170;
            font-family: Lato, Helvetica, Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        #navbar {
            background: #217170;
            color: rgb(13, 26, 38);
        }

        #navbar .nav-link:hover {
            color: #000;
        }

        .menuIcon {
            cursor: pointer;
            display: block;
            position: fixed;
            right: 15px;
            top: 20px;
            height: 23px;
            width: 27px;
            z-index: 12;
        }

        .icon-bars {
            background: rgb(13, 26, 38);
            height: 2px;
            width: 20px;
            position: absolute;
            left: 1px;
            top: 45%;
            transition: 0.4s;
        }

        .icon-bars::before,
        .icon-bars::after {
            content: '';
            background: rgb(13, 26, 38);
            position: absolute;
            height: 2px;
            width: 20px;
            transition: 0.4s;
        }

        .icon-bars::before {
            top: -8px;
        }

        .icon-bars::after {
            top: 8px;
        }

        .menuIcon.toggle .icon-bars {
            transform: translate3d(0, 5px, 0) rotate(135deg);
        }

        .menuIcon.toggle .icon-bars::before {
            top: 0;
            opacity: 0;
        }

        .menuIcon.toggle .icon-bars::after {
            top: 0;
            transform: translate3d(0, -10px, 0) rotate(-270deg);
        }

        .overlay-menu {
            background: lightblue;
            color: rgb(13, 26, 38);
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            right: 0;
            transform: translateX(-100%);
            width: 100vw;
            height: 100vh;
            transition: transform 0.2s ease-out;
        }

        .overlay-menu ul,
        .overlay-menu li {
            display: block;
        }

        .overlay-menu li a {
            font-size: 1.8em;
            letter-spacing: 4px;
            padding: 10px 0;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .overlay-menu li a:hover,
        .overlay-menu li a:active {
            color: rgb(28, 121, 184);
        }
    </style>

    <link rel="stylesheet" href="{{ asset('/assets/css/snackbar.min.css') }}">
    <script src="{{ asset('/assets/js/snackbar.min.js') }}"></script>
</head>

<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" width="200">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 11.8rem">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-5">
                <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" class="img-fluid">

                <div class="text-center text-white mt-4">
                    <h3 class="text-lead text-white">Aplikasi <br> SPP SMK Diponegoro
                    </h3>
                </div>
            </div>
            <div class="col-lg-5 col-md-7">
                <div class="card bg-white border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small>Sign in with credentials</small>
                        </div>
                        <form role="form" action="{{ route('login.store') }}" method="POST">
                            @csrf

                            <div class="form-group
                                mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="username" placeholder="Username" type="username"
                                        value="{{ old('username') }}">
                                </div>
                                @error('username')
                                    <div class="text-danger d-block">*{{ $message }} <i class="fas fa-arrow-up"></i>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group
                                mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <input class="form-control" name="password" placeholder="Password" type="password"
                                        value="{{ old('password') }}" id="password">
                                </div>
                                @error('password')
                                    <div class="text-danger d-block">*{{ $message }} <i class="fas fa-arrow-up"></i>
                                    </div>
                                @enderror
                            </div>

                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin"
                                    type="checkbox">
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted
                                        ">Remember me</span>
                                </label>
                            </div>

                            <div class="flex items
                                -center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login-siswa') }}">
                                    Login Siswa
                                </a>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Sign in</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menuIcon">
        <span class="icon icon-bars"></span>
        <span class="icon icon-bars overlay"></span>
    </div>

    <div class="overlay-menu">
        <ul class="menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Navigation
        // Responsive Toggle Navigation =============================================
        let menuIcon = document.querySelector('.menuIcon');
        let nav = document.querySelector('.overlay-menu');

        menuIcon.addEventListener('click', () => {
            if (nav.style.transform != 'translateX(0%)') {
                nav.style.transform = 'translateX(0%)';
                nav.style.transition = 'transform 0.2s ease-out';
            } else {
                nav.style.transform = 'translateX(-100%)';
                nav.style.transition = 'transform 0.2s ease-out';
            }
        });

        // Toggle Menu Icon ========================================
        let toggleIcon = document.querySelector('.menuIcon');

        toggleIcon.addEventListener('click', () => {
            if (toggleIcon.className != 'menuIcon toggle') {
                toggleIcon.className += ' toggle';
            } else {
                toggleIcon.className = 'menuIcon';
            }
        });
    </script>

    <script>
        @if (Session::has('success'))
            Snackbar.show({
            text: "{{ session('success') }}",
            backgroundColor: '#28a745',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('error'))
            Snackbar.show({
            text: "{{ session('error') }}",
            backgroundColor: '#dc3545',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('info'))
            Snackbar.show({
            text: "{{ session('info') }}",
            backgroundColor: '#17a2b8',
            actionTextColor: '#212529',
            })
        @endif;
    </script>
</body>

</html>
