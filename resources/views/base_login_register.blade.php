<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/style.css')}}">
    <style>
        body {
            background-image: linear-gradient(to right, #2c3e50, #3498db);
        }
    </style>
</head>
<body>

    <header class="text-center"></header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('animes.index') }}">
                    <img src="{{ URL::asset('/assets/logo.png') }}" alt="logo..." width="110">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::current()->getName() == 'animes.index' ? 'active' : '' }} btn btn-link text-white" href="{{ route('animes.index') }}">Animes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::current()->getName() == 'studios.index' ? 'active' : '' }} btn btn-link text-white" href="{{ route('studios.index') }}">Studios</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 18px;">
                                <i class="fa-solid fa-user-secret me-2" style="font-size: 20px;"></i> Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" style="  background-color: #343a40;">
                                <li>
                                    <form action="{{ route('login') }}" method="GET" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-white">
                                            <i class="fa-solid fa-sign-in-alt me-2"></i> Login
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('register') }}" method="GET" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-white">
                                            <i class="fa-solid fa-user-plus me-2"></i> Register
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-white">
                                            <i class="fa-solid fa-sign-out-alt me-2"></i> Exit
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>



                </div>
            </div>
        </nav>

    <div class="container-fluid">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
