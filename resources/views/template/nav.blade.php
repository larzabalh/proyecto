<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>IT</b>Ventas</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>FINANZAS</b></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/plugins/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">EQUIPO DE FINANZAS</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="/plugins/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  <p>
                    www.finanzas.com - Desarrollando Software
                    <small>www.finanzas.com</small>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">

                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                  </div>
                </li>
              </ul>
            </li>

          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>
          <li>
            <a href="#">
              <i class="fa fa-tasks"></i> <span>Escritorio</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Configuracion</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('tipos_de_gastos.index')}}"><i class="fa fa-circle-o"></i> Tipos de Gastos</a></li>
              <li><a href="{{ route('gasto.index')}}"><i class="fa fa-circle-o"></i> Gastos</a></li>
              <li><a href="{{route ('clientes.index')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Registracion</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route ('ingresos.index')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
              <li><a href="{{route ('registrodegastos.index')}}"><i class="fa fa-circle-o"></i> Egresos</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Vistas</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i>
                  <span>EGRESOS</span>
                   <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{route ('vistas.egresos.tipo')}}"><i class="fa fa-circle-o"></i> TIPO</a></li>
                  <li><a href="cliente.php"><i class="fa fa-circle-o"></i> GASTO</a></li>
                  <li><a href="{{route ('vistas.egresos.tipo_gasto')}}"><i class="fa fa-circle-o"></i> TIPO-GASTO</a></li>
                </ul>
              </li>
            </ul>
            <ul class="treeview-menu">
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-shopping-cart"></i>
                  <span>INGRESOS</span>
                   <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="venta.php"><i class="fa fa-circle-o"></i> INGRESOS</a></li>
                  <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Acceso</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
              <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>

            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              <small class="label pull-right bg-red">PDF</small>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
              <small class="label pull-right bg-yellow">IT</small>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
