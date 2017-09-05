@extends('layouts.app')
@section('htmlheader_title')
    Modificar Usuario
@endsection
@section('main-content')
            <!-- Small boxes (Stat box) -->
    <div class="container">
        <div class="row" >
            <div class="">
                <div class="panel panel-default" id="headeremi">
                    <div class="panel-heading text-center ">Modificar Usuario</div>
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
                        <form method="post" class="form-horizontal" enctype="multipart/form-data" role="form"  action="{{ url('Admin/save_modificar')  }}"  >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $kardex->id }}">
                            <div class="form-group">
                                <label for="nombres" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Nombres</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="nombres" name="nombres"  required value="{{ $kardex->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="father" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Apellido Paterno</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="father" name="father"  required value="{{ $kardex->ap_patern }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mother" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">Apellido Materno</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="mother" name="mother" value="{{ $kardex->ap_mother }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="col-md-4 control-label colorazul letragrande" style="font-size: 1.2em">CI</label>
                                <div class="col-md-6">
                                    <input type="text" onkeypress="return justNumbers(event);" class="form-control" id="titulo" name="ci" required
                                           value="{{ $kardex->ci }}">
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
                                <strong>!!Felicidades!!</strong>Se Creo el curso Correctamente <br><br>
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