<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('panel')}}"><img class="d-inline-block align-center" style="height: 2.5rem;" src="{{ asset('assets/img/logocaslrsystem.png') }}" alt="LOGO"> Club San Lorenzo</a>
    
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <!--
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    -->
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="small userFont">Hola {{ auth()->user()->name }}</div>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!--
                <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-gear"></i> Configuración</a></li>
                <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-chart-line"></i> Actividad</a></li>
                -->
                
                <!--<li><hr class="dropdown-divider" /></li>-->
                <li><a class="dropdown-item" href="{{ route('manual') }}"><i class="fa-solid fa-book"></i> Manual de usuario</a></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</a></li>
            </ul>
        </li>
    </ul>
</nav>