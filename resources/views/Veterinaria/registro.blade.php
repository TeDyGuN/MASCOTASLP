@extends('layouts.app')
@section('htmlheader_title')
    Registrar Veterinaria
@endsection
@section('main-content')
    <!-- Small boxes (Stat box) -->
    <div class="container">
        <div class="row" >
            <div class="">
                <div class="panel panel-default" id="headeremi">
                    <div class="panel-heading text-center ">Registro Nueva Veterinaria</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Hay problemas con tus Entradas<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('veterinaria/save')  }}"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="nombres" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Nombre</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nombres" name="nombre"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="father" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Direccion</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="father" name="direccion"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Telefono</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="email" name="telefono" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="est" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Venta de Mascotas</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="est" name="venta">
                                            <option>Si</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="otros" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Servicios</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="otros" name="servicios"  required></textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary center-block">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        {{$success = Session::get('success')}}
                        @if ($success)
                            <div class="alert alert-success">
                                <strong>!!Felicidades!!</strong>Se Registro a la Veterinaria Correctamente <br><br>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addscripts')
    <script type="text/javascript">
        function justNumbers(e)
        {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }
    </script>
@endsection