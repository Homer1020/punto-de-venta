@extends('template')
@section('title', 'Detalles de compra')
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Compras</h1>
  <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
      <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compras</a></li>
      <li class="breadcrumb-item active">Detalles de compra</li>
  </ol>
</div>

<div class="container">
  <div class="card mb-3">
    <div class="card-body">
      <div class="row mb-3">
        <label for="tipo_comprobante" class="col-sm-4 col-form-label">Tipo de comprobante</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="tipo_comprobante" value="{{ $compra->comprobante->tipo_comprobante }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="numero_comprobante" class="col-sm-4 col-form-label">Numero de comprobante</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="numero_comprobante" value="{{ $compra->numero_comprobante }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="proveedor" class="col-sm-4 col-form-label">Proveedor</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="proveedor" value="{{ $compra->proveedore->persona->razon_social }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="fecha" class="col-sm-4 col-form-label">Fecha</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="fecha" value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('d-m-Y') }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="hora" class="col-sm-4 col-form-label">Hora</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="hora" value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('H:i') }}">
        </div>
      </div>

      <div class="row mb-3">
        <label for="impuesto" class="col-sm-4 col-form-label">Impuesto</label>
        <div class="col-sm-8">
          <input disabled type="text" class="form-control" id="impuesto" value="{{ $compra->impuesto }}">
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <i class="fa fa-table me-1"></i>
      Tabla detalles de la compra
    </div>
    <div class="card-body table-responsive">
      <table class="table table-striped">
        <thead class="bg-primary text-white">
          <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($compra->productos as $producto)
            <tr>
              <td>{{ $producto->nombre }}</td>
              <td>{{ $producto->pivot->cantidad }}</td>
              <td>{{ $producto->pivot->precio_compra }}</td>
              <td>{{ $producto->pivot->precio_venta }}</td>
              <td class="td-subtotal">{{ $producto->pivot->cantidad * $producto->pivot->precio_compra }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3"></th>
            <th>Sumas</th>
            <th id="th-suma"></th>
          </tr>
          <tr>
            <th colspan="3"></th>
            <th>IGV</th>
            <th id="th-igv">{{ $compra->impuesto }}</th>
          </tr>
          <tr>
            <th colspan="3"></th>
            <th>Total</th>
            <th id="th-total"></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    const $filaSubtotal = Array.from(document.getElementsByClassName('td-subtotal'))
    let count = 0

    $(document).ready(function() {
      calcularValores()
    })

    function calcularValores() {
      $filaSubtotal.forEach($item => {
        count += parseFloat($item.textContent)
      })

      $('#th-suma').html(count)
      $('#th-total').html(count + parseFloat($('#th-igv').text()))
    }
  </script>
@endpush