<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b></b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b></b></span>
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
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/plugins/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">Usuario: {{ auth()->user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <div class="pull-right">
                  <li class="">
                    {{-- <img src="/plugins/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        CERRAR SESION
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                </div>
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
            <a href="{{ route('home')}}">
              <i class="fa fa-tasks"></i> <span>Escritorio</span>
            </a>
            <a href="{{ route('importar.index')}}">
              <i class="fa fa-tasks"></i> <span>IMPORTAR</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Configuracion</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('efectivo.index')}}"><i class="fa fa-circle-o"></i> Cajas y Deudas</a></li>
              <li><a href="{{ route('tipos_de_gastos.index')}}"><i class="fa fa-circle-o"></i> Tipos de Gastos</a></li>
              <li><a href="{{ route('gasto.index')}}"><i class="fa fa-circle-o"></i> Gastos</a></li>
              <li><a href="{{ route('gastos_mensuales.index')}}"><i class="fa fa-circle-o"></i> Gastos Mensuales</a></li>
              <li><a href="{{route ('clientes.index')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
              <li><a href="{{route ('medios.index')}}"><i class="fa fa-circle-o"></i> Medios</a></li>
              <li><a href="{{'/configuracion/disponibilidades'}}"><i class="fa fa-circle-o"></i> Disponibilidades</a></li>
              <li><a href="{{route ('forma_pagos.index')}}"><i class="fa fa-circle-o"></i> Formas de Pagos</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Registracion</span>
               <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route ('ingresos.index')}}"><i class="fa fa-circle-o"></i> Ingresos Masivos</a></li>
              <li><a href="{{route ('egresosMasivos.index')}}"><i class="fa fa-circle-o"></i> Egresos Masivos</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>CTAS CTES</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{'/registros/ctacte/clientes'}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
              <li><a href="{{route ('gastosIndividuales.index')}}"><i class="fa fa-circle-o"></i> Egresos Individuales</a></li>
              <li><a href="{{'/registros/ctacte/disponibilidades'}}"><i class="fa fa-circle-o"></i> Bancos</a></li>
              <!-- <li><a href="{{'/registros/ctacte/cheques'}}"><i class="fa fa-circle-o"></i> Cheques</a></li> -->
              <li><a href="{{route ('cheques.index')}}"><i class="fa fa-circle-o"></i> Cheques</a></li>
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
  @endguest
