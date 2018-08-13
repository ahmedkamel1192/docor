<?php

namespace App\DataTables;

use App\Category;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'categories.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Category::all();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip', // to show export button etc
                'lengthMenu' => [[2, 5, 10, 20, -1], [2, 5, 10, 20, 'All data']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file">Export csv</i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file">Export Excel</i>'],
                    ['extend' => 'reload', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-refresh"></i>'],
                    [
                        'text' => '<i class="fa fa-plus"></i> Create new room', 'className' => 'btn btn-warning', "action" => "function(){
                                window.location.href='" . \URL::current() . "/create ';}"
                    ],
                ]
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
            'name',

            'action',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Categories_' . date('YmdHis');
    }
}
