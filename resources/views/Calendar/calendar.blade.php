<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <title>Calendario</title>


    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" /><!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar 2.2.5-->

    <link href="{{ asset('/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" type="text/css" media="print"/>
    <!-- Theme style -->

    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <link href="{{ asset('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">

@inject('number', 'App\Http\Controllers\Calendar\CalendarInjectionController')
@include('layouts.partials.mainheader')

@include('layouts.partials.sidebar')
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
            </div>
            <div class="modal-body" ng-app="TrabajoApp">
                <div class="form-group">
                    <div class="row">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('calendar/getModified') }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Agregar Descripcion</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="3" placeholder="Agregar Descripcion" name="descripcion"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Agregar Destinatarios</label>
                                    <div class="col-md-7">
                                @if(Auth::user()->type == 'Admin')
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="tutor_on">
                                                Tutores
                                            </label>
                                        </div>
                                @endif
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="cursante_on">
                                                Cursantes
                                            </label>
                                        </div>
                                        <div style="margin-top: 10px" ng-controller="SearchCrtl">
                                            <input id="tutor_input" type="text" class="form-control" placeholder="Ingrese Apellido Usuario"  name="tutor" ng-model="searchInput" ng-change="search()">
                                            <input name="idtutor"  id="idtutor" type="hidden"  value="">
                                            <input name="idevento"  id="idevento" type="hidden"  value="">
                                            <div class="col-md-12 list-group" id="lista">
                                                <a href="#" class="list-group-item" ng-repeat="user in users" ng-click="removeTask(user);">
                                                    <h4 class="list-group-item-heading" >
                                                        @{{ user.first_name + ' ' + user.father_last_name }}
                                                    </h4>
                                                    <p>
                                                        @{{ user.email }}
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg center-block">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color: #144571;
                           font-size: 1.7em;
                           font-weight: bold;">
                EMI|VIRTUAL
                <small>Calendario</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Eventos Guardados</h4>
                        </div>
                        <div class="box-body">
                            <!-- the events -->
                            <div>
                                @foreach($array as $fecha)
                                    <div class="btn-calendar">
                                        @if(Auth::user()->type!="Cursante")
                                            <button id="{{$fecha->start.' '.$fecha->titulo_evento}}" data-toggle="modal" data-target="#login"  value="{{ $fecha->id }}" type="button" class="btn btn-block btn-sm" style="background-color: {{$fecha->backgroundColor}}; color: white; margin-top: 5px;">{{$fecha->titulo_evento.' '.$fecha->start}}</button>
                                        @else
                                            <button class="btn btn-block btn-sm" style="background-color: {{$fecha->backgroundColor}}; color: white; margin-top: 5px;">{{$fecha->titulo_evento.' '.$fecha->start}}</button>
                                        @endif

                                    </div>
                                @endforeach
                                <div>
                                    <div class="checkbox">
                                        <label for='drop-remove'>
                                            <input type='checkbox' id='drop-remove' />
                                            Eliminar despues de Soltar
                                        </label>
                                        <button class="btn btn-default btn-sm" id="trash" style="float: right" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Eventos Arrastrables</h4>
                        </div>
                        <div class="box-body">
                            <!-- the events -->
                            <div id='external-events'>
                                <div class='external-event bg-green'>Ejemplo de Evento Arrastrable</div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Crear Evento</h3>
                        </div>
                        <div class="box-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>

                                </ul>
                            </div><!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Titulo del Evento">
                                <div class="input-group-btn">
                                    <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Añadir</button>
                                </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Acotaciones</h3>
                        </div>
                        <div class="box-header with-border">
                            <h4 class="box-title text-red">Rojo     = Actividad Muy Urgente</h4>
                            <h4 class="box-title text-yellow">Naranja = Actividad Urgente</h4>
                            <h4 class="box-title text-green">Verde    = Actividad Normal</h4>
                            <h4 class="box-title text-yellow">Naranja = Actividad Urgente</h4>

                        </div>
                    </div>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title">Guardar Eventos</h4>
                        </div>
                        <form role="form" id="form-fechas" method="POST" action="{{ url('calendar/calendar/getcalendar') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="fechas" name="fechas" value='MODIFICAR'>
                            <button id="boton-guardar" type="submit" class="btn btn-primary btn-flat center-block">Guardar</button>
                        </form>

                    </div><!-- /. box -->
                </div><!-- /.col -->

                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.footer')
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- jQuery UI 1.11.1 -->
<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- FastClick -->

<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->

<script src="{{asset('/dist/js/app.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js') }}" type="text/javascript"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>

<script src="{{asset('/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
<!-- Page specific script -->

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var base_url = 'http://localhost/proyectoemi/public';
        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Dia'
            },
            monthNames : ['Enero' , 'Febrero' , 'Marzo' , 'Abril' , 'Mayo' , 'Junio' , 'Julio' ,
                'Agosto' , 'Septiembre' , 'Octubre' , 'Noviembre' , 'Diciembre' ],
            dayNamesShort : ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            dayNames : ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            firstDay : 1,
            //Random default events

            events: [
                    @foreach($array as $fecha)
                    {
                        title: '{{$fecha->titulo_evento}}',
                        //start: new Date('{{substr($fecha->start, 0, -15)}}', '{{substr($fecha->start, 5, -12)}}', '{{substr($fecha->start, 8, -9)}}',
                        //        '{{substr($fecha->start, 11, -6)}}', '{{substr($fecha->start, 14, -3)}}'),
                        start: '{{$fecha->start}}',
                        allDay: '{{$fecha->allDay}}',
                        backgroundColor: '{{$fecha->backgroundColor}}', //Blue
                        borderColor: '{{$fecha->borderColor}}'//Blue
                    },
                    @endforeach
            ]
            /*events: [
                {
                    title: 'Laboratorio de Redes',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: "#0073b7", //Blue
                    borderColor: "#0073b7" //Blue
                }
            ]*/,
            editable: true,
            droppable: true,
            draggable: true,
            eventDragStop: function(event,jsEvent,ui ,view) {
                var trashEl = jQuery('#trash');
                var ofs = trashEl.offset();

                var x1 = ofs.left;
                var x2 = ofs.left + trashEl.outerWidth(true);
                var y1 = ofs.top;
                var y2 = ofs.top + trashEl.outerHeight(true);

                if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 &&
                        jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {
                    event.borderColor = 'white';
                    event.backgroundColor = 'white';
                    $('#calendario').fullCalendar('removeEvents', event._id);

                    $('#calendar').fullCalendar('rerenderEvents');

                }
            },
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);;

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = true;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");
                /*console.log(copiedEventObject.title);
                console.log(copiedEventObject.start);
                console.log(copiedEventObject.allDay);
                console.log(copiedEventObject.backgroundColor);
                console.log(copiedEventObject.borderColor);*/
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            }
        });
        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);
            //Add draggable funtionality
            ini_events(event);+

            //Remove event from text input
            $("#new-event").val("");
        });

        $('#boton-guardar').click(function(){
            $('#calendar').fullCalendar('rerenderEvents');
            var eventsFromCalendar = $('#calendar').fullCalendar('clientEvents');
            for (var i = 0; i < eventsFromCalendar.length; i++) {
                delete eventsFromCalendar[i].source;
            }
            var fecha = function (titulo, start, backcolor, allday, bordercolor, id) {
                this.titulo = titulo;
                this.start = start;
                this.backcolor = backcolor;
                this.allday = allday;
                this.bordecolor = bordercolor;
                this.id = id;
            }
            var fechas = [];
            for(var i = 0; i < eventsFromCalendar.length; i++)
            {
                var titulo = eventsFromCalendar[i].title;
                var start = eventsFromCalendar[i].start['_d'];
                console.log(start);
                var backcolor = eventsFromCalendar[i].backgroundColor;
                var allday = eventsFromCalendar[i].allDay;
                var bordercolor = eventsFromCalendar[i].borderColor;
                var id = eventsFromCalendar[i]._id;
                var nose = new fecha(titulo, start, backcolor, allday, bordercolor, id);
                fechas.push(nose);
            }
            for (var i = 0; i < fechas.length; i++) {
                delete fechas[i].source;
            }
            textojson = JSON.stringify(fechas);
            $('#fechas').attr('value', textojson);

        });
        $('.btn-calendar').click(function(){
            //var pp = $(this).parents('button');
            //var ss = document.getElementById ('button_modal').outerText;
            //var ss = document.getElementById ('button_modal').value;
            //var id = pp[0].data('textContent');
            //var id = ('')
            //event.preventDefault();
            var btn = $(this).children();
            var id = btn.attr('id');
            console.log(id);
            var id2 = btn.attr('value');
            $('#idevento').val(id2);
            //2015-10-16T00:00:00
            var titulo = id.slice(19);
            $(".modal-title").text(titulo);
        });

      //  event.preventDefault();
     //   ;*/
        //textojson = JSON.stringify($('#calendar').fullCalendar().events());
        //console.log($('#external-events div.external-event'));
    });

</script>
<script type="text/javascript">
    'use strict';
    var TrabajoApp = angular.module('TrabajoApp', []);
    TrabajoApp.controller('SearchCrtl', function($scope, $http){
        $scope.search = function() {
            $http.get('find',{
                params: {nombre: $scope.searchInput}
            }).success(function (data){
                $scope.users = data;
            });
        };
        $scope.removeTask = function(user){
            var lista = $('#lista');
            lista.css({display: "none"});
            var tutor_in = $('#tutor_input');
            tutor_in.val(user.first_name +' '+user.father_last_name);
            $('#idtutor').attr('value', user.id);
        };

    });
    $('#tutor_input').click(function(){
        var lista = $('#lista');
        lista.css({display: "block"});
    });
</script>
</body>
</html>