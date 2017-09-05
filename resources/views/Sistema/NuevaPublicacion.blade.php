@extends('layouts.app')
@section('htmlheader_title')
    Publicacion
@endsection
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center">{{ $publicacion[0]->titulo  }}</h3>
                </div>
                <div class="panel-body">
                    <p class="text-center text-justify" style="font-size: 1.3em;">{{$publicacion[0]->texto}}</p>

                    @if($publicacion[0]->video<>'')

                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$publicacion[0]->video}}"></iframe>
                            </div>
                        </div>
                    @endif
                    @if($publicacion[0]->rutaArchivo<>'')

                        <div class="image col-sm-6 col-sm-offset-4">
                            <a href="{{url('sistema/storage/'.$publicacion[0]->rutaArchivo)}}"><img src="{{asset('/img/descarga-boton.png')}}" alt="Descargar" class="img-thumbnail"></a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="text-align: center">Tablero de Comentarios</h3>
                </div>
                <div class="panel-body">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Comentario</th>
                                </tr>
                                @foreach($comentarios as $f)
                                    <tr>
                                        <td class="col-md-2">{{$f->fecha}}</td>
                                        <td class="col-md-2">{{ $f->k_name.' '.$f->k_pat }}</td>
                                        <td class="col-md-8">{{ $f->texto }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center">
                    <h3 class="panel-title" style="text-align: center">Formulario de Comentario</h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Existen Problemas con tus Entradas.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('sistema/save_comentario') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="trabajo_id" value="{{ $id  }}"/>
                        {{--<input type="hidden" name="usuario_id" value="{{$trabajos[0]->usuarioid}}"/>--}}
                        <div class="form-group">
                            <label class="col-md-3 control-label colorazul">Comentario</label>
                            <div class="col-md-5">
                                <textarea class="form-control" name="texto" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Registrar Comentario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
