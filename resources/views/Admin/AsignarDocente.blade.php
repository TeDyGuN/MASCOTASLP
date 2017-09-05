@extends('layouts.app')
@section('htmlheader_title')
    Asignar Docente
@endsection
@section('main-content')
            <!-- Small boxes (Stat box) -->
    <div class="container">
        <div class="row" >
            <div class="">
                <div class="table-responsive">
                    <div class="panel panel-default">
                        <div class="panel-heading">Materias no Asignadas</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">Asignatura</th>
                                    <th class="text-center">Curso</th>
                                </tr>
                                @foreach($no_asignadas as $n)
                                    <tr>
                                        <td>{{ $n->nombre }}</td>
                                        <td>{{ $n->cnombre }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default" id="headeremi">
                    <div class="panel-heading text-center ">Asignar Docente</div>
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
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('Admin/asignar/save')  }}"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label colorazul" style="font-size: 1.2em">Docente</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="docente">
                                        @foreach($docentes as $d)
                                            <option value="{{ $d->id }}">{{$d->name.' '.$d->ap_patern.' '.$d->ap_mother}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label colorazul" style="font-size: 1.2em">Materia</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="materia">
                                        @foreach($materias as $m)
                                            <option value="{{ $m->id }}">{{$m->nombre}}</option>
                                        @endforeach
                                    </select>
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
                                <strong>!!Felicidades!!</strong>Se Asigno Docente Correctamente<br><br>
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