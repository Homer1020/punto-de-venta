@extends('template')
@section('title', 'Configuraciones')
@push('css')
  
@endpush
@section('content')
<div class="container-fluid">
  
  <form action="{{ route('profile.update', $user) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row justify-content-center">
      <div class="col-md-9">
        <h1 class="my-4">Perfil de usuario</h1>
        <div class="row mb-3">
          <label for="name" class="col-sm-2 col-form-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label for="email" class="col-sm-2 col-form-label">Correo</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>

        <div class="row mb-3">
          <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
          </div>
        </div>

        <div class="row mb-3">
          <label for="password" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <button class="btn btn-success">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: '{{ session("success") }}'
        });
    </script>
  @endif
@endpush
