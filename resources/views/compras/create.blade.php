@extends('template')
@section('title', 'Crear compra')
@push('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Compras</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compras</a></li>
      <li class="breadcrumb-item active">Crear compra</li>
  </ol>

  <form action="{{ route('compras.store') }}" method="POST">
    @csrf
    <div class="row mb-4">
      <div class="col-md-8">
        <div class="card border-primary mb-3 mb-md-0">
          <div class="card-header">
            <h2 class="h5 m-0">Detalles de la compra</h2>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <div class="col-md-12">
                <label for="producto_id" class="form-label">Productos</label>
                <select
                  name="producto_id"
                  id="producto_id"
                  class="form-control selectpicker show-tick"
                  data-live-search="true"
                  title="Seleccione un producto"
                  data-size="5"
                >
                  @foreach ($productos as $producto)
                      <option value="{{ $producto->id }}">
                        {{ $producto->codigo }} - {{ $producto->nombre }}
                      </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control">
              </div>

              <div class="col-md-4">
                <label for="precio_compra" class="form-label">Precio de compra</label>
                <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.01">
              </div>

              <div class="col-md-4">
                <label for="precio_venta" class="form-label">Precio de venta</label>
                <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.01">
              </div>

              <div class="col-md-12">
                <button id="btn_agregar" type="button" class="btn btn-primary">Agregar</button>
              </div>

              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="tabla_detalle" class="table table-hover">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio de compra</th>
                        <th>Precio de venta</th>
                        <th>Subtotal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5"></th>
                        <th>Suma</th>
                        <th>
                          <span id="sumas">0</span>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="5"></th>
                        <th>IGV</th>
                        <th>
                          <span id="igv">0</span>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="5"></th>
                        <th>Total</th>
                        <th>
                          <input type="hidden" id="input_total" name="total" value="0">
                          <span id="total">0</span>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>

              <div class="col-md-12">
                <button id="cancelar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfirm">
                  Cancelar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-success">
          <div class="card-header">
            <h2 class="h5 m-0">Datos generales</h2>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <div class="col-md-12">
                <label for="proveedore_id" class="form-label">Proveedor</label>
                <select
                  name="proveedore_id"
                  id="proveedore_id"
                  class="form-control selectpicker show-tick"
                  data-live-search="true"
                  title="Seleccione una marca"
                  data-size="5"
                >
                  @foreach ($proveedores as $proveedor)
                      <option value="{{ $proveedor->id }}">
                        {{ $proveedor->persona->razon_social }}
                      </option>
                  @endforeach
                </select>
                @error('proveedore_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-12">
                <label for="numero_comprobante" class="form-label">Comprobante</label>
                <select
                  name="comprobante_id"
                  id="comprobante_id"
                  class="form-control selectpicker show-tick"
                  data-live-search="true"
                  title="Seleccione un comprobante"
                  data-size="5"
                >
                  @foreach ($comprobantes as $comprobante)
                      <option value="{{ $comprobante->id }}">
                        {{ $comprobante->tipo_comprobante }}
                      </option>
                  @endforeach
                </select>
                @error('comprobante_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-12">
                <label for="numero_comprobante" class="form-label">Numero de comprobante</label>
                <input
                  required
                  type="text"
                  name="numero_comprobante"
                  id="numero_comprobante"
                  class="form-control"
                >
                @error('numero_comprobante')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="impuesto" class="form-label">Impuesto</label>
                <input
                  readonly
                  type="text"
                  name="impuesto"
                  id="impuesto"
                  class="form-control border-success"
                >
                @error('impuesto')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha</label>
                <input
                  readonly
                  type="date"
                  name="fecha"
                  id="fecha"
                  class="form-control border-success"
                  value="{{ date('Y-m-d') }}"
                >
                @php
                  $fecha_hora = Carbon\Carbon::now()->toDateTimeString();
                @endphp

                <input type="hidden" name="fecha_hora" value="{{ $fecha_hora }}">
              </div>

              <div class="col-md-12">
                <button id="guardar" type="submit" class="btn btn-success">Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Seguro que quieres cancelar la compra?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn_cancelar_compra" type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#btn_agregar').click(agregarProducto)
    
      $('#btn_cancelar_compra').click(cancelarCompra)

      $('#impuesto').val(impuesto + '%')

      disableButtons()
    })

    let contador = 0
    let subtotal = []
    let sumas = 0
    let igv = 0
    let total = 0

    const impuesto = 18

    function cancelarCompra() {
      $('#tabla_detalle tbody').html(`
        <tr>
          <th></th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      `)

      contador = 0
      subtotal = []
      sumas = 0
      igv = 0
      total = 0

      $('#sumas').text(sumas)
      $('#igv').text(round(igv))
      $('#total').text(round(total))
      $('#impuesto').val(impuesto + '%')
      $('#input_total').val(total)

      limpiarCampos()
      disableButtons()
    }

    function disableButtons() {
      if(total === 0) {
        $('#guardar').hide()
        $('#cancelar').hide()
      } else {
        $('#guardar').show()
        $('#cancelar').show()
      }
    }

    function eliminarProducto(contador) {
      sumas -= round(subtotal[contador])
      igv = round(sumas / 100 * impuesto)
      total = round(sumas + igv)

      $('#sumas').text(sumas)
      $('#igv').text(round(igv))
      $('#total').text(round(total))
      $('#impuesto').val(round(igv))
      $('#input_total').val(total)

      $(`#fila-${contador}`).remove()

      disableButtons()
    }

    function agregarProducto() {
      const id_producto = $('#producto_id').val()
      const nombre_producto = $('#producto_id option:selected')
        .text()
        ?.split(' - ')?.[1]
        ?.replaceAll('\n', '')
        ?.trim()
      const cantidad = $('#cantidad').val()
      const precio_compra = $('#precio_compra').val()
      const precio_venta = $('#precio_venta').val()

      if (!nombre_producto || !cantidad || !precio_compra || !precio_venta) {
        showModal('error', 'Faltan campos por llenar')
        return null
      }

      if(parseInt(cantidad) < 1 && (cantidad % 1 !== 0) && parseFloat(precio_compra) < 0 && parseFloat(precio_venta) < 0) {
        showModal('error', 'Valores incorrectos')
        return null
      }

      if(parseFloat(precio_venta) < parseFloat(precio_compra)) {
        showModal('error', 'El precio de venta debe ser mayor al de compra')
        return null
      }

      subtotal[contador] = cantidad * precio_compra
      sumas += subtotal[contador]
      igv = sumas/100 * impuesto
      total = sumas + igv

      const fila = `
        <tr id="fila-${ contador }">
          <th>
            ${ contador + 1 }
          </th>
          <td>
            <input type="hidden" name="arrayidproducto[]" value="${id_producto}" />
            ${ nombre_producto }
            </td>
          <td>
            <input type="hidden" name="arraycantidad[]" value="${cantidad}" />
            ${ cantidad }
            </td>
          <td>
            <input type="hidden" name="arraypreciocompra[]" value="${precio_compra}" />
            ${ precio_compra }
          </td>
          <td>
            <input type="hidden" name="arrayprecioventa[]" value="${precio_venta}" />
            ${ precio_venta }
          </td>
          <td>${ subtotal[contador] }</td>
          <td>
            <button type="button" onclick="eliminarProducto(${ contador })" class="btn btn-danger"><i class="fa fa-trash"></i></button>  
          </td>
        </tr>
      `.trim()

      $('#tabla_detalle tbody').append(fila)

      contador++

      $('#sumas').text(sumas)
      $('#igv').text(round(igv))
      $('#total').text(round(total))
      $('#impuesto').val(round(igv))
      $('#input_total').val(total)

      limpiarCampos()

      disableButtons()
    }

    function limpiarCampos() {
      const select = $('#producto_id')
      select.selectpicker()
      select.selectpicker('val', '')

      $('#cantidad').val('')
      $('#precio_compra').val('')
      $('#precio_venta').val('')
    }

    function round(num, decimales = 2) {
      var signo = (num >= 0 ? 1 : -1);
      num = num * signo;
      if (decimales === 0) //con 0 decimales
          return signo * Math.round(num);
      // round(x * 10 ^ decimales)
      num = num.toString().split('e');
      num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
      // x * 10 ^ (-decimales)
      num = num.toString().split('e');
      return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }

    function showModal(icon, message) {
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
          icon: icon,
          title: message
        });
    }
  </script>
@endpush