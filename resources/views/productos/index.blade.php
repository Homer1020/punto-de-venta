@extends('template')
@section('title', 'Productos')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Productos</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item active">Productos</li>
  </ol>

  <a href="{{ route('productos.create') }}" class="btn btn-primary mb-4">Agregar nuevo registro</a>

  <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabla productos
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Presentacion</th>
                    <th>Categorias</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($productos as $producto)
                <tr>
                  <td>{{ $producto->codigo }}</td>
                  <td>{{ $producto->nombre }}</td>
                  <td>{{ $producto->marca->caracteristica->nombre }}</td>
                  <td>{{ $producto->presentacione->caracteristica->nombre }}</td>
                  <td>
                    @foreach ($producto->categorias as $categoria)
                      <span class="badge bg-secondary">
                        {{ $categoria->caracteristica->nombre }}
                      </span>
                    @endforeach
                  </td>
                  <td>{!! $producto->estado ? '<span class="badge bg-primary">Activo</span>' : '<span class="badge bg-danger">Eliminado</span>' !!}</td>
                  <td>
                    <div class="modal fade" id="exampleModal-{{ $producto->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles del producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <ul class="list-group">
                              <li class="list-group-item">
                                <span class="fw-bolder">Descripcion: </span> {{ $producto->descripcion }}
                              </li>
                              <li class="list-group-item">
                                <span class="fw-bolder">Fecha de vencimiento: </span> {{ $producto->fecha_vencimiento ?? 'No tiene' }}
                              </li>
                              <li class="list-group-item">
                                <span class="fw-bolder">Stock: </span> {{ $producto->stock }}
                              </li>
                              <li class="list-group-item">
                                <span class="fw-bolder">Imagen:
                                @if ($producto->img_path)
                                  <img src="{{ Storage::url('public/productos/' . $producto->img_path) }}" alt="{{ $producto->nombre }}" class="img-thumbnail">
                                @endif
                              </li>
                            </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                      @method('DELETE')
                      @csrf
                    </form>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                      @if ($producto->estado)
                        <button type="button" onclick="eliminar(this)" class="btn btn-danger">Eliminar</button>
                      @else
                        <button type="button" onclick="eliminar(this, true)" class="btn btn-success">Recuperar</button>
                      @endif
                      <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">Editar</a>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $producto->id }}">
                        Visualizar
                      </button>
                      
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