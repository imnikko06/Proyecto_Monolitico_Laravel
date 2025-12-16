@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detalle de la Petición #{{ $petition->id }}</h5>
        </div>

        <div class="card-body">
            <p><strong>Título:</strong> {{ $petition->title }}</p>
            <p><strong>Descripción:</strong> {{ $petition->description }}</p>
            <p><strong>Destinatario:</strong> {{ $petition->destinatary }}</p>
            <p><strong>Usuario:</strong> {{ $petition->user->name }}</p>
            <p><strong>Categoría:</strong> {{ $petition->category->name ?? 'Sin categoría' }}</p>
            <p><strong>Firmas:</strong> {{ $petition->signers }}</p>
            <p>
                <strong>Estado:</strong>
                <span class="badge {{ $petition->status == 'accepted' ? 'bg-success' : 'bg-secondary' }}">
                {{ $petition->status }}
            </span>
            </p>
            <p><strong>Creado:</strong> {{ $petition->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $petition->updated_at }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.petitions.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('admin.petitions.edit', $petition->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
@endsection
