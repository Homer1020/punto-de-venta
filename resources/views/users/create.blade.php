@extends('template')
@section('title', 'Crear usuario')
@push('css')
  
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Usuarios</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
      <li class="breadcrumb-item active">Crear usuario</li>
  </ol>

  <form action="{{ route('users.store') }}" method="POST">
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

          <div class="row mb-3">
            <label for="email" class="col-sm-4 col-form-label">Correo</label>
            <div class="col-sm-8">
              <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="email">
              @error('email')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="password" class="col-sm-4 col-form-label">Contraseña</label>
            <div class="col-sm-8">
              <input name="password" type="password" class="form-control" id="password">
              @error('password')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="password_confirm" class="col-sm-4 col-form-label">Repetir contraseña</label>
            <div class="col-sm-8">
              <input name="password_confirm" type="password" class="form-control" id="password_confirm">
              @error('password_confirm')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label for="role" class="col-sm-4 col-form-label">Seleccionar rol</label>
            <div class="col-sm-8">
              <select class="form-select" name="role" id="role">
                <option selected disabled>Seleccione</option>
                @foreach ($roles as $rol)
                  <option value="{{ $rol->name }}" @selected(old('role') === $rol->name)>{{ $rol->name }}</option>
                @endforeach
              </select>
              @error('password_confirm')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
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