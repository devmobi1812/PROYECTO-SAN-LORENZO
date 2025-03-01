<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                
                <div class="sb-sidenav-menu-heading">Núcleo</div>
                <a class="nav-link" href="{{ route('panel')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel
                </a>
                <!--
                <div class="sb-sidenav-menu-heading">Interfaz</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Distribución
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('login')}}">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('401')}}">401 Page</a>
                                <a class="nav-link" href="{{ route('404')}}">404 Page</a>
                                <a class="nav-link" href="{{ route('500')}}">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
            -->
                <div class="sb-sidenav-menu-heading">Gestión</div>
                <a class="nav-link" href="{{ route('alquileres') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-dollar-to-slot"></i></div><!-- el default <i class="fas fa-table"> -->
                    Alquileres
                </a>
                <a class="nav-link" href="{{ route('alquileres-historico') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div><!-- el default <i class="fas fa-table"> -->
                    Histórico
                </a>
                <a class="nav-link" href="{{ route('clientes') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div><!-- el default <i class="fas fa-chart-area"> -->
                    Clientes
                </a>
                <a class="nav-link" href="{{ route('servicios') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div><!-- el default <i class="fas fa-table"> -->
                    Servicios
                </a>
                <a class="nav-link" href="{{ route('turnos') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                    Turnos
                </a>
                <a class="nav-link" href="{{ route('productos')}}"> 
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                    Productos
                </a>
                <a class="nav-link" href="{{ route('descuentos')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-percent"></i></div>
                    Descuentos
                </a>
                <a class="nav-link" href="{{ route('depositos')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                    Depositos
                </a>
                <a class="nav-link" href="{{ route('metododepagos')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-credit-card"></i></div>
                    Metodos de Pago
                </a>
                <a class="nav-link" href="{{ route('usuarios')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                    Usuarios
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Versión 1.95.105</div>
        </div>
    </nav>
</div>