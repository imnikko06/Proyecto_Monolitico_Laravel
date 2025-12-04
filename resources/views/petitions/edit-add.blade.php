@extends('layouts.public')

@section('content')
    <div class="container my-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h2 class="mb-4">Crear Nueva Petición</h2>

        <form method="post" action="{{ route('petitions.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="title" id="titulo" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="description" id="descripcion" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="destinatary" class="form-label">Destinatario</label>
                <textarea name="destinatary" id="destinatary" class="form-control @error('destinatary') is-invalid @enderror" rows="2" required>{{ old('destinatary') }}</textarea>
                @error('destinatary')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select @error('category_id') is-invalid @enderror">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Sube una imagen</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" aria-required="true">
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enviar petición nueva</button>
            </div>
        </form>
    </div>
@endsection
