@php
    use Illuminate\Support\Facades\Auth;
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>Change.org</title>
    <meta charset="utf‐8">
    <meta name="viewport" content="width=device‐width, initial‐scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="{{asset('assets/css/index.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
    <div class="container">

        <a class="navbar-brand" href="{{route('home')}}">
            <img src="../assets/img/logo.png" alt="Logo" height="28">
        </a>

        @if (Auth::check())
            <a href="./makeapetition.html" class="btn btn-outline-dark btn-sm d-lg-none btn-mobile-nav" style="font-weight: 600; border-color: #333; color: #333; border-radius: 6px; font-size: 0.9rem; padding: 0.3rem 0.6rem;" onclick="window.location.href = './makeapetition.html'">Inicia una petición</a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center d-none d-lg-flex">

                @if (Auth::check())
                    <li class="nav-item"><a class="nav-link" href="{{route('petitions.mine')}}">Mis peticiones</a></li>
                @endif

                <li class="nav-item"><a class="nav-link" href="{{route('petitions.index')}}">Mas Peticiones</a></li>

                @if (Auth::check())
                    <li class="nav-item"><a class="nav-link" href="{{route('petitions.signedPetitions')}}">Mis Peticiones Firmadas</a></li>

                    <li class="nav-item position-relative">
                        <i class="fas fa-search position-absolute"
                           style="right: 15px; top: 50%; transform: translateY(-50%); color:#888;"></i>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{route('petitions.create')}}">Inicia una Peticion</a></li>
                @endif

            </ul>

            <div class="d-none d-lg-flex align-items-center gap-3 flex-wrap">

                @if(Auth::check())
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="img-xs rounded-circle" style="width: 40px" src="{{ asset('assets/img/foto.png') }}" alt="Profile image"> </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown">
                                <div class="dropdown-header text-center">
                                    <p class="mb-1 mt-3 font-weight-semibold">{{Auth::user()->name}}</p>
                                    <p class="font-weight-light text-muted mb-0">{{Auth::user()->email}}</p>
                                </div>
                                <a class="dropdown-item" href ="{{route('profile.edit')}}">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" >Sign Out<i class="dropdown-item-icon ti-dashboard"></i></a>
                                <form id="logout" action="{{route('logout')}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>

                @else
                    <a class="nav-link fs-5 m-2 link-danger" href="{{route('register')}}">Register</a>
                    <a class="nav-link fs-5 m-2 link-danger" href="{{route('login')}}">Login</a>

                @endif
            </div>

            <ul class="navbar-nav d-lg-none mt-3 nav-mobile-menu">

                @if (Auth::check())
                    <li class="nav-item border-top">
                        <a class="nav-link" href="{{route('petitions.mine')}}">Mis peticiones</a>
                    </li>
                    <li class="nav-item border-top">
                        <a class="nav-link" href="{{route('petitions.signedPetitions')}}">Mis Peticiones Firmadas</a>
                    </li>
                    <li class="nav-item border-top">
                        <a class="nav-link" href="{{route('petitions.create')}}">Inicia una Peticion</a>
                    </li>
                @endif

                <li class="nav-item border-top">
                    <a class="nav-link" href="{{route('petitions.index')}}">Mas Peticiones</a>
                </li>

                <li class="nav-item border-top">
                    <a class="nav-link" href="#">Buscar</a>
                </li>

                @if (Auth::check())
                    <li class="nav-item border-top">
                        <a class="nav-link" href="{{route('profile.edit')}}">Mi Perfil</a>
                    </li>
                    <li class="nav-item border-top border-bottom">
                        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-mobile').submit();" >Cerrar Sesión</a>
                        <form id="logout-mobile" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item border-top border-bottom">
                        <a class="nav-link" href="{{route('login')}}">Entra o regístrate</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@yield('content')
<footer>
    <div class="container">
        <div class="row g-4" style="user-select: none;">

            <div class="col-6 col-lg-3 footer-col">
                <h6>Acerca de</h6>
                <ul>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Impacto</a></li>
                    <li><a href="#">Empleo</a></li>
                    <li><a href="#">Equipo</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3 footer-col">
                <h6>Comunidad</h6>
                <ul>
                    <li><a href="#">Prensa</a></li>
                    <li><a href="#">Normas</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3 footer-col">
                <h6>Ayuda</h6>
                <ul>
                    <li><a href="#">Ayuda</a></li>
                    <li><a href="#">Guías</a></li>
                    <li><a href="#">Privacidad</a></li>
                    <li><a href="#">Términos</a></li>
                    <li><a href="#">Accesibilidad</a></li>
                    <li><a href="#">Cookies</a></li>
                    <li><a href="#">Gestionar cookies</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3 footer-col">
                <h6>Redes sociales</h6>
                <ul class="social-list">
                    <li><a href="#">X</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">TikTok</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!‐‐ <script src="{{asset('vendor/assets/vendors/js/vendor.bundle.base.js')}}"></script>‐‐>
<!‐‐ <script src="{{asset('vendor/assets/vendors/js/vendor.bundle.addons.js')}}"></script>‐‐>
<!‐‐ <script src="{{asset("vendor/assets/js/shared/off‐canvas.js")}}"></script>‐‐>
<!‐‐ <script src="{{asset("vendor/assets/js/shared/misc.js")}}"></script>‐‐>
<!‐‐ <script src="{{asset("vendor/assets/js/demo_1/dashboard.js")}}"></script>‐‐>
</body>
</html>
