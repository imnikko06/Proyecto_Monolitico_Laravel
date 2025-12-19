@php
    use Illuminate\Support\Facades\Auth;
@endphp
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@auth
    @if(Auth::user()->role_id == 2)

        <div class="d-flex" id="wrapper">
            <div class="bg-danger border-right" id="sidebar-wrapper" style="min-height: 100vh; width: 250px;">
                <div class="sidebar-heading text-white p-3 border-bottom border-light">
                    <h4 class="mb-0">change.org</h4>
                </div>
                <div class="list-group list-group-flush">
                    <div class="d-flex align-items-center p-3">
                        <img src="{{asset('assets/img/foto.png')}}" alt="Admin" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                        <span class="text-white">Admin</span>
                    </div>
                    <h6 class="text-white p-3 mb-0">Main Menu</h6>
                    <a href="{{ route('admin.petitions.index') }}" class="list-group-item list-group-item-action bg-danger text-white {{ Request::routeIs('admin.petitions.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt mr-2"></i> Peticiones
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-danger text-white {{ Request::routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags mr-2"></i> Categorías
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-danger text-white {{ Request::routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users mr-2"></i> Usuarios
                    </a>
                </div>
            </div>

            <div id="page-content-wrapper" style="width: calc(100% - 250px);">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="d-none d-lg-flex align-items-center gap-3 flex-wrap ms-auto">
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

                    </div>
                </nav>

                <div class="container-fluid p-4">
                    @yield('content')
                </div>

            </div>
        </div>

        @push('styles')
            <style>
                #sidebar-wrapper {
                    transition: margin .25s ease-out;
                    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
                }
                .sidebar-heading {
                    text-align: center;
                }
                .list-group-item.active {
                    background-color: #c82333 !important;
                    border-color: #c82333 !important;
                }
            </style>
        @endpush

    @else
        <div class="alert alert-danger text-center" role="alert">
            Acceso Denegado. No tienes permisos de administrador.
        </div>
    @endif
@endauth

@guest
    <div class="alert alert-warning text-center" role="alert">
        Debes iniciar sesión para acceder al panel de administración.
        <a href="{{ route('login') }}">Ir al login</a>
    </div>
@endguest
