@extends('layouts.app')
@section('htmlheader_title')
    Admin
@endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{count(\App\User::all())}}</h3>
                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ url('users') }}" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{count(\App\Mascota::all())}}</h3>
                    <p>Mascotas Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ url('mascotas') }}" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div><!-- /.row -->
</div>
@endsection
