<?php

namespace App\DataTables;

use App\Kardex;
use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
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
//	    $users = Kardex::select('name as Nombre', 'ap_patern as Apellido', 'ci as Carnet',
//		    \DB::raw('(CASE WHEN sex <> 0 THEN "Hombre" ELSE "Mujer" END) as Genero'),
//		    \DB::raw('(CASE WHEN user_type = 1 THEN "Admin" WHEN user_type = 2 THEN "Empleado" ELSE "Usuario" END) as Cargo')
//	    );
	    $users = Kardex::select();
	    return $this->applyScopes($users);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
//        return $this->builder()
//                    ->columns($this->getColumns())
//                    ->ajax('')
//                    ->addAction(['width' => '80px'])
//                    ->parameters($this->getBuilderParameters());
	    return $this->builder()
	                ->columns([
		                'name',
		                'ap_patern',
		                'ap_mother',
		                'ci',
		                'user_type',
//		                'email'

	                ])
	                ->parameters([
		                'dom' => 'Bfrtip',
		                'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
	                ]);
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
        return 'usersdatatables_' . time();
    }
}
