<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link active">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li> 
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library 
        <li class="nav-item menu-open">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-csv"></i>
                <p>
                    CSV
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/csv/historico" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/historico' ? 'active' : ''; ?>">
                        <i class="fas fa-history nav-icon"></i>
                        <p>Histórico</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/csv/grupos-edad" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/grupos-edad' ? 'active' : ''; ?>">
                        <i class="fas fa-restroom nav-icon"></i>
                        <p>Grupos Edad</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/csv/totales-2020" class="nav-link <?php echo isset($seccion) && $seccion === '/csv/totales-2020' ? 'active' : ''; ?>">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Totales 2020</p>
                    </a>
                </li>
            </ul>
        </li>   
        -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    DB
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/usuarios" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios' ? 'active' : ''; ?>">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Todos usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/usuarios/ordered" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios/ordered' ? 'active' : ''; ?>">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Ordenados salar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/usuarios/estandard" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios/estandard' ? 'active' : ''; ?>">
                        <i class="fas fa-user-injured nav-icon"></i>
                        <p>Estándard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/usuarios/carlos" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios/carlos' ? 'active' : ''; ?>">
                        <i class="fas fa-user-astronaut nav-icon"></i>
                        <p>Usuarios Carlos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/proveedores" class="nav-link <?php echo isset($seccion) && $seccion === '/usuarios/carlos' ? 'active' : ''; ?>">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p>Proveedores</p>
                    </a>
                </li>
            </ul>
        </li>                   
    </ul>
</nav>
<!-- /.sidebar-menu -->