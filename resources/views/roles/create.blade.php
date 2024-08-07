@extends('template')
@section('title', 'Crear categoria')
@push('css')
  
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Roles</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
      <li class="breadcrumb-item active">Crear rol</li>
  </ol>

  <form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="row mb-3">
            <label for="name" class="col-sm-4 col-form-label">Nombre</label>
            <div class="col-sm-8">
              <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="name">
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="col-12">
            <label for="permisos" class="form-label">Permisos</label>
            @foreach ($permisos as $permiso)
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $permiso->name }}" id="{{ $permiso->id }}" name="permisos[]">
                <label class="form-check-label" for="{{ $permiso->id }}">
                  {{ $permiso->name }}
                </label>
              </div>
            @endforeach
            @error('permisos')
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