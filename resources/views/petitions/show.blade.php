@extends('layouts.public')

@section('content')
    <main class="container my-4">

        <div class="row g-4">

            <div class="col-lg-8">
                <div class="p-4 p-md-5 main-content">

                    <h1 class="h2 fw-bold mb-3">{{ $petition->title }}</h1>
                    <img src="{{ asset($petition->files->first() ? $petition->files->first()->file_path : 'assets/img/foto.png') }}"
                         alt="Imagen de la petición">

                    <p class="text-muted" style="font-weight: 500;">
                        <i class="fa-solid fa-user-group me-1"></i> {{ $petition->signers()->count() }} firmantes
                    </p>

                    <section class="petition-body mt-4">
                        <h2 class="fw-bold">El problema</h2>
                        <p>{{ $petition->description }}</p>
                        <a href="#" class="text-decoration-none" style="font-size: 0.9rem;">
                            <i class="fa-solid fa-flag me-1"></i> Denunciar una violación de las políticas
                        </a>
                    </section>

                    <section class="author-box d-flex align-items-center gap-3 my-4">
                        <div class="author-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold">{{ $petition->user->name }}</div>
                            <div class="text-muted" style="font-size: 0.9rem;">Creador de la petición</div>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm" style="font-weight: 600;">Consultas de medios</button>
                    </section>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-form">
                    <div class="petition-form-card">

                        <h3 class="h1 fw-bold">{{ $petition->signers()->count() }}
                            <i class="fa-solid fa-check text-success" style="font-size: 1.5rem;"></i>
                        </h3>
                        <p class="fw-semibold">Firma esta petición</p>

                        {{-- Mensajes de éxito o error --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        @auth
                            <form action="{{ route('petitions.sign', $petition->id) }}" method="POST">
                                @csrf
                                <div class="d-grid">
                                    <button class="btn btn-yellow" type="submit" style="border-radius: 8px; padding: 0.75rem;">
                                        Firma la petición
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-yellow w-100">
                                Inicia sesión para firmar
                            </a>
                        @endauth

                        <p class="text-muted mt-3" style="font-size: 0.75rem;">
                            Si firmas, aceptas los Términos de servicio y la Política de privacidad de Change.org.
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
