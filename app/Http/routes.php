<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect()->guest('login');
});
Route::resource('users', 'UsersController');
Route::resource('codigos', 'CodigosController');
Route::resource('mascotas', 'MascotasController');
Route::resource('veterinarias', 'VeterinariasController');
Route::group(['middleware' => ['admin'], 'namespace' => 'Admin', 'prefix' => 'Admin'], function()
{
    Route::get('/', 'GeneralController@index');

    Route::get('crear/materia', 'AcademicoController@materia');
    Route::post('materia/save', 'AcademicoController@save_materia');


    Route::get('asignar/docente', 'AcademicoController@asignar_docente');
    Route::post('asignar/save', 'AcademicoController@save_asignar');

    Route::get('asignar/estudiante', 'AcademicoController@asignar_estudiante');
    Route::post('asignar/estudiante', 'AcademicoController@save_asignar_estudiante');

    Route::get('crear/admin', 'UsuarioController@admin');
    Route::post('admin/save', 'UsuarioController@save_admin');
    Route::get('crear/docente', 'UsuarioController@docente');
    Route::post('docente/save', 'UsuarioController@save_docente');
    Route::get('crear/estudiante', 'UsuarioController@estudiante');
    Route::post('estudiante/save', 'UsuarioController@save_estudiante');
    Route::Resource('users', 'GestionUsuarioController');
    Route::post('modificar', 'UsuarioController@modificar');
    Route::get('retornar', 'UsuarioController@retornar');
    Route::post('save_modificar', 'UsuarioController@save_modificar');

    Route::get('crear/masivo', 'UsuarioController@masivo');
    Route::get('descargarExcel', 'UsuarioController@getExcel');

    Route::post('subir_plantilla', 'UsuarioController@subir_plantilla');
    //ACADEMICO
});
Route::group(['middleware' => ['docente'], 'namespace' => 'Docente', 'prefix' => 'Docente'], function()
{
    Route::get('/', 'DocenteController@index');
});
Route::group(['middleware' => ['estudiante'], 'namespace' => 'Estudiante', 'prefix' => 'Estudiante'], function()
{
    Route::get('/', 'EstudianteController@index');
});
//CALENDARIO
Route::group(['prefix'=> 'calendar', 'namespace' => 'Calendar'], function() {
    route::get('calendar', 'FullCalendarController@getCalendar');
    route::get('calendar/number', 'FullCalendarController@getNumberEvents');
    Route::post('calendar/getcalendar', 'FullCalendarController@calendarevents');
    Route::post('getModified', 'FullCalendarController@getModified');
    Route::get('find', 'FullCalendarController@buscar');
});
Route::group(['prefix'=> 'sistema', 'namespace' => 'Sistema'], function() {
    Route::get('asignatura/{id}', 'AsignaturaController@index');
    Route::post('getPublicacion', 'AsignaturaController@getPublicacion');
    Route::get('publicacion/{id}', 'AsignaturaController@publicacion');

    Route::post('save_comentario', 'AsignaturaController@save_comentario');
    Route::get('storage/{archivo}', function ($archivo) {
        $url = storage_path('app/').$archivo;
        //verificamos si el archivo existe y lo retornamos
        if (\Illuminate\Support\Facades\Storage::exists($archivo))
        {
            return response()->download($url);
        }
        //si no se encuentra lanzamos un error 404.
        abort(404);

    });
    //Route::post('getPublicacion', 'AsignaturaController@getPublicacion');
});
Route::group(['prefix'=> 'nfc', 'namespace' => 'NFC'], function() {
	Route::post('save', 'NFCController@save');
	Route::get('crear/nfc', 'NFCController@getViewSave');
	Route::get('crear/nfce', 'NFCController@getExvelSave');
	Route::post('saveCSV', 'NFCController@saveCSV');
	//Route::post('getPublicacion', 'AsignaturaController@getPublicacion');
});
Route::group(['prefix'=> 'mascota', 'namespace' => 'Mascota'], function() {
	Route::post('save', 'MascotaController@saveMascota');
	Route::get('crear', 'MascotaController@getViewSave');
//	Route::get('crear/nfce', 'NFCController@getExvelSave');
//	Route::post('saveCSV', 'NFCController@saveCSV');
	//Route::post('getPublicacion', 'AsignaturaController@getPublicacion');
});
Route::group(['prefix'=> 'veterinaria', 'namespace' => 'Veterinaria'], function() {
	Route::post('save', 'VeterinariaController@saveVeterinaria');
	Route::get('crear', 'VeterinariaController@getViewSave');
//	Route::get('crear/nfce', 'NFCController@getExvelSave');
//	Route::post('saveCSV', 'NFCController@saveCSV');
	//Route::post('getPublicacion', 'AsignaturaController@getPublicacion');
});