@extends('layouts.app')
@section('htmlheader_title')
    Registrar Mascota
@endsection
@section('main-content')
    <!-- Small boxes (Stat box) -->
    <div class="container">
        <div class="row" >
            <div class="">
                <div class="panel panel-default" id="headeremi">
                    <div class="panel-heading text-center ">Registro Nueva Mascota</div>
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
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('mascota/save')  }}"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="panel-heading text-center ">Datos del Dueño</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="nombres" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Nombres</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nombres" name="nombres"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="father" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Apellidos</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="father" name="father"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ci" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">CI</label>
                                    <div class="col-md-6">
                                        <input type="text" onkeypress="return justNumbers(event);" class="form-control" id="ci" name="ci" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="direccion" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Direccion</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="direccion" name="direccion"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telefono" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Telefono</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="telefono" name="telefono"  required>
                                    </div>
                                </div> <div class="form-group">
                                    <label for="celular" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Telefono Celular</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="celular" name="celular"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-heading text-center ">Datos de la Mascota</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="nombres" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Nombre</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nombrem" name="nombrem"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="raza" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Raza</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="raza" name="raza"  required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="color" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Color de Pelaje</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="color" name="color"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="peso" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Peso (Kg.)</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="peso" name="peso"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="codigo" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Codio NFC</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{$codigo[0]['codigo']}}" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="otros" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Otras Caracteristicas</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="otros" name="otros"  required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary center-block">
                                    Registrar
                                </button>
                            </div>
                        </form>
                        <br><br>
                        {{$success = Session::get('success')}}
                        @if ($success)
                            <div class="alert alert-success">
                                <strong>!!Felicidades!!</strong>Se Creo el Estudiante Correctamente <br><br>
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