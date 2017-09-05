<?php

namespace App\DataTables;

use App\Codigo;
use App\User;
use Yajra\Datatables\Services\DataTable;

class CodigosDataTable extends DataTable
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
	    $codigos = Codigo::select();
	    return $this->applyScopes($codigos);
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
		                'codigo',
		                'uso'

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
        return 'codigosdatatables_' . time();
    }
}
