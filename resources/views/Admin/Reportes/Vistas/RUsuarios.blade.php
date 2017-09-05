@extends('Plantilla/plantilla')
@section('titulo', 'Reportes Usuarios')
@section('headerpage')
    <section class="content-header"  xmlns="http://www.w3.org/1999/html">
        <h1 class="colorazul">
            SIS|TRAIN
            <small class="colorazul">Reportes</small>
        </h1>
    </section>
@endsection
@section('content')
    <div class="container-fluid" ng-app="Usuarios">
        <div class="row">
            <div class="table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">Generacion de Reportes</div>
                    <div class="panel-body">
                        <!-- Tab panes -->
                        <div ng-controller="SearchCrtl">

                            <form method="post" class="form-horizontal" role="form"  action="{{ url('sistema/reportes/estudiante/pdf') }}"  >
                                <div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox1" name="ci" value="kardex.ci" checked> CI
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox2" name="curso" value="c.nombre" checked> Curso
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox3" name="sexo" value="kardex.sexo" checked>Sexo
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox4" name="email" value="u.email" checked> Email
                                    </label>
                                </div>
                                <div class="form-group" style="margin-top: 20px">
                                    <div class="col-md-2">
                                        <select class="form-control" name="reglas" ng-model="searchSelect">
                                            <option selected="selected" value="ap_paterno">Apellidos</option>
                                            <option value="ci">CI</option>
                                            <option value="email">Email</option>
                                            <option value="curso">Curso</option>
                                        </select>
                                    </div>
                                    <div class="input-group col-md-10">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-zoom-in"></span>
                                        </div>
                                        <div class="">
                                            <input type="text" class="form-control" id="buscar_id" name="buscar" placeholder="Buscar" ng-model="searchInput" ng-change="search()">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="">
                                    <button type="submit" id="boton-tabla" class="btn btn-primary center-block">
                                        Generar Reporte en Pdf
                                    </button>
                                </div>
                            </form>
                            <form method="post" class="form-horizontal" role="form"  action="{{ url('sistema/reportes/estudiante/excel') }}"  >
                                <div class="">
                                    <button type="submit" id="boton-tabla" class="btn btn-primary center-block">
                                        Generar Reporte General en Excel
                                    </button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table id="table-data" class="table table-striped table-bordered">
                                    <tr>
                                        <th id="nombres">Nombres</th>
                                        <th id="apellido">Apellidos</th>
                                        <th id="ci">CI</th>
                                        <th id="curso">Curso</th>
                                        <th id="esp">Sexo</th>
                                        <th id="email">Email</th>
                                    </tr>
                                    <tr ng-repeat="u in users">

                                        <td>@{{ u.nombres }}</td>
                                        <td>@{{ u.ap_paterno + ' ' + u.ap_materno }}</td>
                                        <td>@{{ u.ci }}</td>
                                        <td>@{{ u.nombre }}</td>
                                        <td ng-if="u.sexo == 0">Femenino</td>
                                        <td ng-if="u.sexo == 1">Masculino</td>
                                        <td>@{{ u.email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addscripts')
    <script type="text/javascript">
        'use strict';
        var UsuariosApp = angular.module('Usuarios', []);
        UsuariosApp.controller('SearchCrtl', function($scope, $http){
            $http.get('find',{
                params: {nombre: $scope.searchInput,
                    tipo: 'ap_paterno'}
            }).success(function (data){
                $scope.users = data;
            });
            $scope.search = function() {
                $http.get('find',{
                    params: {nombre: $scope.searchInput,
                        tipo: $scope.searchSelect}
                }).success(function (data){
                    $scope.users = data;
                });
            };
        });
        $('#inlineCheckbox1').change(function(){
            if(!$('#inlineCheckbox1').attr('checked'))
            {
                $('th:nth-child(3)').hide();
                $('td:nth-child(3)').hide();
            }
            else
            {
                $('th:nth-child(3)').show();
                $('td:nth-child(3)').show();
            }
        });
        $('#inlineCheckbox2').change(function(){
            if(!$('#inlineCheckbox2').attr('checked'))
            {
                $('th:nth-child(4)').hide();
                $('td:nth-child(4)').hide();
            }
            else
            {
                $('th:nth-child(4)').show();
                $('td:nth-child(4)').show();
            }
        });
        $('#inlineCheckbox3').change(function(){
            if(!$('#inlineCheckbox3').attr('checked'))
            {
                $('th:nth-child(5)').hide();
                $('td:nth-child(5)').hide();
            }
            else
            {
                $('th:nth-child(5)').show();
                $('td:nth-child(5)').show();
            }
        });
        $('#inlineCheckbox4').change(function(){
            if(!$('#inlineCheckbox4').attr('checked'))
            {
                $('th:nth-child(6)').hide();
                $('td:nth-child(6)').hide();
            }
            else
            {
                $('th:nth-child(6)').show();
                $('td:nth-child(6)').show();
            }
        });
        $('#inlineCheckbox5').change(function(){
            if(!$('#inlineCheckbox5').attr('checked'))
            {
                $('th:nth-child(7)').hide();
                $('td:nth-child(7)').hide();
            }
            else
            {
                $('th:nth-child(7)').show();
                $('td:nth-child(7)').show();
            }
        });
        $('#inlineCheckbox6').change(function(){
            if(!$('#inlineCheckbox6').attr('checked'))
            {
                $('th:nth-child(8)').hide();
                $('td:nth-child(8)').hide();
            }
            else
            {
                $('th:nth-child(8)').show();
                $('td:nth-child(8)').show();
            }
        });
        $('#inlineCheckbox7').change(function(){
            if(!$('#inlineCheckbox7').attr('checked'))
            {
                $('th:nth-child(9)').hide();
                $('td:nth-child(9)').hide();
            }
            else
            {
                $('th:nth-child(9)').show();
                $('td:nth-child(9)').show();
            }
        });
        $('#inlineCheckbox8').change(function(){
            if(!$('#inlineCheckbox8').attr('checked'))
            {
                $('th:nth-child(10)').hide();
                $('td:nth-child(10)').hide();
            }
            else
            {
                $('th:nth-child(10)').show();
                $('td:nth-child(10)').show();
            }
        });
    </script>
@endsection