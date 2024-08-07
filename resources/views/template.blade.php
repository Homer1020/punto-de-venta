<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="Sistema de punto de venta" />
      <meta name="author" content="Homer Moncayo" />
      <title>Punto de ventas | @yield('title')</title>
      <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
      @stack('css')
      <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
  </head>
  <body class="sb-nav-fixed">
      <x-navigation />
      <div id="layoutSidenav">
          <x-sidebar />
          <div id="layoutSidenav_content">
              <main>
                  @yield('content')
              </main>
              <x-footer />
          </div>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('js/scripts.js') }}"></script>
      @stack('js')
  </body>
</html>
