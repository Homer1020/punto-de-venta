@extends('template')
@section('title', 'Editar categoria')
@push('css')
  
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Categorias</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias</a></li>
      <li class="breadcrumb-item active">Editar categoria</li>
  </ol>

  <form action="{{ route('categorias.update', $categoria) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre:</label>
            <input
              class="form-control"
              type="text" 
              name="nombre"
              id="nombre"
              value="{{ old('nombre', $categoria->caracteristica->nombre) }}"
            >
            @error('nombre')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="descripcion" class="form-label">Descripcion:</label>
            <textarea
              name="descripcion"
              id="descripcion"
              rows="1"
              class="form-control"
            >{{ old('descripcion', $categoria->caracteristica->descripcion) }}</textarea>
            @error('descripcion')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
  
@endpush