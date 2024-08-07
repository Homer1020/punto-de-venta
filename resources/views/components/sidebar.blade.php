<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Inicio</div>
                <a class="nav-link {{ request()->routeIs('panel') ? 'active' : '' }}" href="{{ route('panel') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>
                {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                {{-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> --}}
                <div class="sb-sidenav-menu-heading">Modulos</div>
                <a class="nav-link {{ request()->routeIs('compras.*') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="{{ request()->routeIs('compras.*') ? 'true' : 'false' }}" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Compras
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="{{ request()->routeIs('compras.*') ? 'collapse show' : 'collapse' }}" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->routeIs('compras.index') ? 'active' : '' }}" href="{{ route('compras.index') }}">Ver</a>
                        <a class="nav-link {{ request()->routeIs('compras.create') ? 'active' : '' }}" href="{{ route('compras.create') }}">Crear</a>
                    </nav>
                </div>

                <a class="nav-link {{ request()->routeIs('ventas.*') ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsVentas"
                    aria-expanded="{{ request()->routeIs('ventas.*') ? 'true' : 'false' }}" aria-controls="collapseLayoutsVentas">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Ventas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="{{ request()->routeIs('ventas.*') ? 'collapse show' : 'collapse' }}" id="collapseLayoutsVentas" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->routeIs('ventas.index') ? 'active' : '' }}" href="{{ route('ventas.index') }}">Ver</a>
                        <a class="nav-link {{ request()->routeIs('ventas.create') ? 'active' : '' }}" href="{{ route('ventas.create') }}">Crear</a>
                    </nav>
                </div>
                <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}"
                    href="{{ route('categorias.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                    Categorias
                </a>
                <a class="nav-link {{ request()->routeIs('presentaciones.*') ? 'active' : '' }}"
                    href="{{ route('presentaciones.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-archive"></i></div>
                    Presentaciones
                </a>
                <a class="nav-link {{ request()->routeIs('marcas.*') ? 'active' : '' }}"
                    href="{{ route('marcas.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                    Marcas
                </a>
                <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}"
                    href="{{ route('productos.index') }}">
                    <div class="sb-nav-link-icon"><i class="fab fa-shopify"></i></div>
                    Productos
                </a>
                <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                    href="{{ route('clientes.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                    Clientes
                </a>
                <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}"
                    href="{{ route('proveedores.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-handshake"></i></div>
                    Proveedores
                </a>
                <div class="sb-sidenav-menu-heading">Otros</div>
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                    Usuarios
                </a>
                <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-person-circle-plus"></i></div>
                    Roles
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Bienvenido:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>