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
                'lengthMenu' => [[ 5, 10, 20, -1], [ 5, 10, 20, 'All data']],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'csv', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file">Export csv</i>'],
                    ['extend' => 'excel', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-file">Export Excel</i>'],
                    ['extend' => 'reload', 'className' => 'btn btn-info', 'text' => '<i class="fa fa-refresh"></i>'],
                
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
            [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID'
            ],

            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],


            [
                'name' => 'action',
                'data' => 'action',
                'title' => 'Actions'
            ],

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
