<!-- Left side column. contains the logo and sidebar -->
@inject('number', 'App\Http\Controllers\Calendar\CalendarInjectionController')
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->apellido() }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            @if(Auth::user()->tipo_usuario==1)
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-user"></i><span>Gestion de Usuario</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('Admin/crear/admin') }}"><i class="fa fa-circle-o"></i>Crear Administrador</a></li>
                        {{--<li><a href="{{ url('Admin/crear/empleado') }}"><i class="fa fa-circle-o"></i>Crear Empleado</a></li>--}}
                        {{--<li><a href="{{ url('Admin/crear/usuario') }}"><i class="fa fa-circle-o"></i>Crear Usuario</a></li>--}}
                        {{--<li><a href="{{ url('Admin/crear/masivo') }}"><i class="fa fa-circle-o"></i>Crear Masivo</a></li>--}}
                        <li><a href="{{ route('Admin.users.index') }}"><i class="fa fa-circle-o"></i>Modificar Usuario</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-user"></i><span>Registro de Codigo NFC</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('nfc/crear/nfc') }}"><i class="fa fa-circle-o"></i>Registrar NFC</a></li>
                        <li><a href="{{ url('nfc/crear/nfce')  }}"><i class="fa fa-circle-o"></i>Registrar NFC Masivo</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-user"></i><span>Registro de Mascotas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('mascota/crear') }}"><i class="fa fa-circle-o"></i>Registrar Mascota</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="">                                                                                          {{--<li class="treeview">--}}
                        <i class="fa fa-user"></i><span>Registro de Veterinarias</span>                                          {{--<a href="">--}}
                        <i class="fa fa-angle-left pull-right"></i>                                                              {{--<i class="fa fa-mortar-board "></i><span>Gestion Academica</span>--}}
                    </a>                                                                                                         {{--<i class="fa fa-angle-left pull-right"></i>--}}
                    <ul class="treeview-menu">                                                                               {{--</a>--}}
                        <li><a href="{{ url('veterinaria/crear') }}"><i class="fa fa-circle-o"></i>Registrar Veterinarias</a></li>    {{--<ul class="treeview-menu">--}}
                    </ul>                                                                                                        {{--<li><a href="{{ url('Admin/crear/materia') }}"><i class="fa fa-circle-o"></i>Crear Asignatura</a></li>--}}
                </li>                                                                                                        {{--</ul>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ url('Admin/asignar/docente') }}"><i class="fa fa-circle-o"></i>Asignar Docente</a></li>--}}
                    {{--</ul>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ url('Admin/asignar/estudiante') }}"><i class="fa fa-circle-o"></i>Asignar Estudiantes</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="treeview">
                    <a href="">
                        <i class="fa fa-mortar-board "></i><span>Reportes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('users') }}"><i class="fa fa-circle-o"></i>Reporte de Usuarios</a></li>
                    </ul>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('codigos') }}"><i class="fa fa-circle-o"></i>Reporte de Codigos NFC</a></li>
                    </ul>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('mascotas') }}"><i class="fa fa-circle-o"></i>Reporte de Mascotas</a></li>
                    </ul>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('veterinarias') }}"><i class="fa fa-circle-o"></i>Reporte de Veterinarias</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->tipo_usuario==2)
                <li>
                    <a href="{{ url('home') }}9">
                        <i class="fa fa-calendar"></i> <span>Mis Cursos</span>
                    </a>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
