@extends('layouts.app')
@section('htmlheader_title')
    Crear Estudiante
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">Descargar Plantilla Estudiantes Masivos</div>
                    <div class="panel-body">
                        <a class="text-bold" style="font-size: 1.3em" href='{{url('Admin/descargarExcel')}}'>Descargar Plantilla</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Cargar Estudiantes Masivos</div>
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
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('Admin/subir_plantilla')  }}"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="numero" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Numero Estudiantes:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="numero" name="numero"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="archivo" class="col-md-4 control-label colorazul" style="font-size: 1.2em">Archivo</label>
                                <div class="col-md-3">
                                    <input type="file" required name="archivo" id="archivo"/>
                                </div>
                                <label for="archivo" class="col-md-3 control-label colorazul">Solo Archivos Excel: .xls .xlsx</label>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary center-block">
                                    Subir Plantilla
                                </button>
                            </div>
                        </form>
                        <br><br>
                        {{$success = Session::get('success')}}
                        @if ($success)
                            <div class="alert alert-success">
                                <strong>!!Felicidades!!</strong>Se Crearon Usuarios Masivamente <br><br>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
