@extends('layouts.public')
@section('content')

    <section class="py-5">
        <div class="container">

            <h2 class="fw-bold mb-4">Peticiones Firmadas por ti </h2>
            <div class="row g-4 mb-5">
                @foreach($petitions as $petition)
                    <div class="col-lg-3 col-md-6">
                        <div class="petition-card card h-100">
                            <img src="{{ asset($petition->files->first() ? $petition->files->first()->file_path : 'assets/img/foto.png') }}"
                                 alt="Imagen de la petición">

                            <div class="card-body petition-content">
                                <div class="petition-sponsor mb-2">Patrocinado por {{ $petition->signers }} firmantes</div>
                                <h5 class="petition-title card-title">{{ $petition->title }}</h5>
                                <p class="petition-description card-text">{{ $petition->description }}</p>
                                <div class="petition-author mb-2">Autor de la Petición</div>
                                <div class="petition-signatures mb-3">{{ $petition->signers }} Firmantes</div>
                                <a href="{{ route('petitions.show', $petition->id) }}" class="btn btn-outline-secondary btn-sign w-100">Firma esta petición</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(method_exists($petitions, 'links'))
                <div class="d-flex justify-content-center">
                    {{ $petitions->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection
