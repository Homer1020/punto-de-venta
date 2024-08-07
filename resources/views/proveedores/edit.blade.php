@extends('template')
@section('title', 'Editar proveedor')
@push('css')
  <style>
    #box-razon-social {
      display: none;
    }
  </style>
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Proveedores</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
      <li class="breadcrumb-item active">Editar proveedor</li>
  </ol>

  <form action="{{ route('proveedores.update', $proveedore) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
      <div class="card-body">
        <div class="row g-4">
          <div class="col-md-6">
            <label for="tipo_persona" class="form-label">Tipo de cliente: {{ $proveedore->persona->tipo_persona }}</label>
          </div>
          <div class="col-md-6">
            @if ($proveedore->persona->tipo_persona === 'natural')
              <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos</label>
            @else
              <label id="label-juridico" for="razon_social" class="form-label">Nombre de la empresa</label>
            @endif

            <input
              type="text"
              name="razon_social"
              id="razon_social"
              class="form-control"
              value="{{ old('razon_social', $proveedore->persona->razon_social) }}"
            >
            @error('razon_social')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col-md-12">
            <label for="direccion" class="form-label">Direccion</label>
            <input
              name="direccion"
              type="text"
              class="form-control"
              id="direccion"
              value="{{ old('direccion', $proveedore->persona->direccion) }}"
            >
            @error('direccion')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="documento_id" class="form-label">Tipo de documento</label>
            <select
              name="documento_id"
              id="documento_id"
              class="form-select"
            >
              <option selected disabled>Seleccione una opcion</option>
              @foreach ($documentos as $documento)
                <option value="{{ $documento->id }}" {{ old('documento_id', $proveedore->persona->documento->id) == $documento->id ? 'selected' : '' }}>{{ $documento->tipo_documento }}</option>
              @endforeach
            </select>
            @error('documento_id')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="numero_documento" class="form-label">Numero de documento</label>
            <input
              name="numero_documento"
              type="text"
              class="form-control"
              id="numero_documento"
              value="{{ old('numero_documento', $proveedore->persona->numero_documento) }}"
            >
            @error('numero_documento')
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