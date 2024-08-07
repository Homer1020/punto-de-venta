@extends('template')
@section('title', 'Crear producto')
@push('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Productos</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
      <li class="breadcrumb-item active">Crear producto</li>
  </ol>

  <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
      <div class="col-md-6">
        <label for="codigo" class="form-label">Codigo:</label>
        <input
          type="text"
          class="form-control"
          id="codigo"
          name="codigo"
          value="{{ old('codigo') }}"
        >
        @error('codigo')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre:</label>
        <input
          type="text"
          class="form-control"
          id="nombre"
          name="nombre"
          value="{{ old('nombre') }}"
        >
        @error('nombre')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-12">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea
          class="form-control"
          id="descripcion"
          name="descripcion"
          rows="3"
        >{{ old('descripcion') }}</textarea>
        @error('descripcion')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento:</label>
        <input
          type="date"
          class="form-control"
          id="fecha_vencimiento"
          name="fecha_vencimiento"
          value="{{ old('fecha_vencimiento') }}"
        >
        @error('fecha_vencimiento')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="img_path" class="form-label">Imagen:</label>
        <input
          id="img_path"
          type="file"
          class="form-control"
          name="img_path"
          value="{{ old('img_path') }}"
          accept="image/*"
        >
        @error('img_path')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="marca_id" class="form-label">Marcas:</label>
        <select
          id="marca_id"
          name="marca_id"
          class="form-control selectpicker show-tick"
          data-live-search="true"
          title="Seleccione una marca"
          data-size="5"
        >
          @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : '' }}>{{ $marca->caracteristica->nombre }}</option>
          @endforeach
        </select>
        @error('marca_id')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="presentacione_id" class="form-label">Presentacion:</label>
        <select
          id="presentacione_id"
          class="form-control selectpicker show-tick"
          name="presentacione_id"
          data-live-search="true"
          data-size="5"
          title="Seleccione una presentacion"
        >
          @foreach ($presentaciones as $presentacione)
            <option value="{{ $presentacione->id }}" {{ old('presentacione_id') == $presentacione->id ? 'selected' : '' }}>{{ $presentacione->caracteristica->nombre }}</option>
          @endforeach
        </select>
        @error('presentacione_id')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="categorias" class="form-label">Categorias:</label>
        <select
          id="categorias"
          class="form-control selectpicker show-tick"
          name="categorias[]"
          data-live-search="true"
          data-size="5"
          title="Seleccione las categorias"
          multiple
        >
          @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ in_array($categoria->id, old('categorias', [])) ? 'selected' : '' }}>{{ $categoria->caracteristica->nombre }}</option>
          @endforeach
        </select>
        @error('categorias')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="col-12 mt-5">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </form>
</div>
@endsection
@push('js')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush