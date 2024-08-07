@extends('template')
@section('title', 'Listado de ventas')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Ventas</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item active">Ventas</li>
  </ol>

  <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-4">Agregar nuevo registro</a>

  <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabla ventas
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Comprobante</th>
                    <th>Cliente</th>
                    <th>Fecha y hora</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
              @foreach($ventas as $venta)
                <tr>
                  <td>
                    <p class="fw-semibold mb-0">{{ $venta->comprobante->tipo_comprobante }}</p>
                    <p class="text-muted mb-0">{{ $venta->numero_comprobante }}</p>
                  </td>
                  <td>
                    <p class="fw-semibold mb-0">{{ ucfirst($venta->cliente->persona->tipo_persona) }}</p>
                    <p class="text-muted mb-0">{{ $venta->cliente->persona->razon_social }}</p>
                  </td>
                  <td>{{ $venta->fecha_hora }}</td>
                  <td>{{ $venta->user->name }}</td>
                  <td>{{ $venta->total }}</td>
                  <td>
                    <form action="{{ route('ventas.destroy', $venta) }}" method="post">
                        @csrf
                        @method('DELETE')
                    </form>
                    <div class="btn-group" role="group">
                        <a href="{{ route('ventas.show', $venta) }}" class="btn btn-success">Detalles</a>
                        @if ($venta->estado)
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