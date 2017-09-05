<?php

namespace App\DataTables;

use App\Mascota;
use App\User;
use Yajra\Datatables\Services\DataTable;

class MascotasDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
	    return $this->datatables
		    ->eloquent($this->query())
		    ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
//	    $docentes = Kardex::join('users as u', 'id_user', '=', 'u.id')
//	                      ->select('u.id','name', 'ap_patern', 'ap_mother')
//	                      ->where('user_type', '=', '2')
//	                      ->get();
	    $mascotas = Mascota::select();

	    return $this->applyScopes($mascotas);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
	    return $this->builder()
	                ->columns([
		                'dnombre',
		                'dapellido',
		                'demail',
		                'dci',
		                'direccion',
		                'dtelefono',
		                'dcelular',
		                'mnombre',
		                'mraza',
		                'mcolor',
		                'mpeso',
		                'codigo',

	                ])
	                ->parameters([
		                'dom' => 'Bfrtip',
		                'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
	                ]);
	    /*
	     * protected $fillable = ['id', 'dnombre', 'dapellido', 'demail', 'dci', 'direccion', 'dtelefono', 'dcelular', 'mnombre'
		, 'mraza', 'mcolor', 'mpeso', 'motros', 'id_codigo'];
	     * */
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            // add your columns
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'mascotasdatatables_' . time();
    }
}
