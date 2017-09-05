@extends('layouts.app')
@section('htmlheader_title')
    Lista de Publicaciones
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">Publicaciones Curso</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <th class="col-md-4">Titulo</th>
                                <th class="col-md-4">Autor</th>
                                <th class="col-md-3">Fecha</th>
                                <th class="col-md-1">Categoria</th>
                            </tr>
                            @foreach($publicaciones as $t)
                                <tr>
                                    <td>
                                        <a href="{{url('sistema/publicacion/'.$t->id)}}">{{$t->titulo}}</a>
                                    </td>
                                    <td>{{$t->k_name.' '.$t->k_pat}}</td>
                                    <td>{{$t->fecha}}</td>
                                    @if( $t->categoria === 1)

                                        <td class="col-md-1"><span class="label label-primary">Trabajo Practico</span></td>
                                    @elseif( $t->categoria === 2)
                                        <td class="col-md-1"><span class="label label-danger">Comunicado</span></td>
                                    @elseif( $t->categoria === 3)
                                        <td class="col-md-1"><span class="label label-info">Video</span></td>
                                    @elseif( $t->categoria === 4)
                                        <td class="col-md-1"><span class="label label-success">Complemento de Clase</span></td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                        {!! $publicaciones->setPath($id); !!}
                    </div>
                </div>

            </div>
            <div class="panel panel-default" id="headeremi">
                <div class="panel-heading ">Nueva Publicacion</div>
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
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('sistema/getPublicacion')  }}"  >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id }}">
                        {{--<input type="hidden" name="trueid" value="{{ $id }}">--}}
                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Titulo</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="titulo" name="titulo" onBlur="upperM(this)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipo" class="col-md-4 control-label colorazul" style="font-size: 1.2em">Descripcion</label>
                            <div class="col-md-6">
                                <textarea name="descripcion" class="form-control" rows="3" onBlur="upperM(this)" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label colorazul" style="font-size: 1.2em">Categoria</label>
                            <div class="col-md-6">
                                <select class="form-control" name="categoria">
                                    <option value="1">Trabajo Practico</option>
                                    <option value="2">Comunicado</option>
                                    <option value="3">Video</option>
                                    <option value="4">Complemento de Clase</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="video" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Video (Opcional)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="video" name="video" onBlur="upperM(this)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="archivo" class="col-md-4 control-label colorazul" style="font-size: 1.2em">Archivo (Opcional)</label>
                            <div class="col-md-3">
                                <input type="file" name="archivo" id="archivo"/>
                            </div>
                            <label for="archivo" class="col-md-3 control-label colorazul">Solo Archivos: .doc .docx .pdf</label>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary center-block">
                                Subir Publicacion
                            </button>
                        </div>
                    </form>
                    <br><br>
                    {{$success = Session::get('success')}}
                    @if ($success)
                        <div class="alert alert-success">
                            <strong>!!Felicidades!!</strong>Registraste tu Publicacion con Exito<br><br>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
