@extends('layouts.app')
@section('htmlheader_title')
    Docente Home
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center">{{ Auth::user()->tipo() }}</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-2 hidden-xs">
                        <img src="{{ asset("/img/user2-160x160.png") }}" alt="Foto" class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-md-10">
                        <div class="col-md-10">
                            <label class="col-md-4 col-ls-4 control-label colorazul">Nombre y Apellidos:</label>
                            <label class="col-md-4 col-ls-4 control-label">{{ Auth::user()->apellido() }}</label>
                        </div>
                        <div class="col-md-10">
                            <label class="col-md-4  col-ls-4 control-label colorazul">Carnet de Identidad:</label>
                            <label class="col-md-4 col-ls-4 control-label">{{ Auth::user()->ci() }}</label>
                        </div>
                        <div class="col-md-10">
                            <label class="col-md-4  col-ls-4 control-label colorazul">Correo Electronico:</label>
                            <label class="col-md-4 col-ls-4 control-label">{{ Auth::user()->email }}</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center">Asignaturas Asignadas</h3>
                </div>
                <div class="panel-body">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Nombre Materia</th>
                                    <th>Curso</th>
                                </tr>
                                @foreach($materias as $m)
                                    <tr>
                                        <td class="col-md-6"><a href="{{url('sistema/asignatura/'.$m->id)}}">{{$m->nombre}}</a></td>

                                        <td class="col-md-6">{{ $m->cnombre }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
@endsection