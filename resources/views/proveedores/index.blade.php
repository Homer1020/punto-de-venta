@extends('template')
@section('title', 'Listado de proveedores')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Proveedores</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item active">Proveedores</li>
  </ol>

  <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-4">Agregar nuevo registro</a>

  <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabla proveedores
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Documento</th>
                    <th>Tipo de persona</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                  <tr>
                    <td>{{ $proveedor->persona->razon_social }}</td>
                    <td>{{ $proveedor->persona->direccion }}</td>
                    <td>
                        <span class="fw-bold">{{ $proveedor->persona->documento->tipo_documento }}:</span>
                        <span>{{ $proveedor->persona->numero_documento }}</span>
                    </td>
                    <td>{{ $proveedor->persona->tipo_persona }}</td>
                    <td>
                        @if ($proveedor->persona->estado)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-success">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                        <div class="btn-group">
                            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-warning">Editar</a>
                            @if ($proveedor->persona->estado)
                                <button type="button" onclick="eliminar(this)" class="btn btn-danger">Eliminar</button>
                            @else
                                <button type="button" onclick="eliminar(this, true)" class="btn btn-success">Recuperar</button>
                            @endif
                        </div>
                    </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script>
        function eliminar($button, isToRestore) {
            Swal.fire({
                title: "Estas seguro?",
                text: "No podras revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: !isToRestore ? "Si, eliminar!" : "Si, recuperar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $button.parentElement.previousElementSibling.submit()
                }
            });
        }
    </script>
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