@extends('layouts.public')

@section('content')
    <div class="container my-5">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h2 class="mb-4">
            {{ isset($petition) ? 'Editar Petición' : 'Crear Nueva Petición' }}
        </h2>

        <form method="post"
              action="{{ isset($petition) ? route('petitions.update', $petition->id) : route('petitions.store') }}"
              enctype="multipart/form-data">
            @csrf
            @if(isset($petition))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="title" id="titulo"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $petition->title ?? '') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="description" id="descripcion"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4">{{ old('description', $petition->description ?? '') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="destinatary" class="form-label">Destinatario</label>
                <textarea name="destinatary" id="destinatary"
                          class="form-control @error('destinatary') is-invalid @enderror"
                          rows="2" required>{{ old('destinatary', $petition->destinatary ?? '') }}</textarea>
                @error('destinatary')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoría</label>
                <select name="category_id" id="category" class="form-select @error('category_id') is-invalid @enderror">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ (old('category_id', $petition->category_id ?? '') == $categoria->id) ? 'selected' : '' }}>
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
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">

                @if(isset($petition) && $petition->files->first())
                    <p class="mt-2">Archivo actual: {{ $petition->files->first()->name }}</p>
                    <img src="{{ asset($petition->files->first()->file_path) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 200px;">
                @endif

                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ isset($petition) ? 'Actualizar Petición' : 'Enviar Petición Nueva' }}
                </button>
            </div>
        </form>
    </div>
@endsection
