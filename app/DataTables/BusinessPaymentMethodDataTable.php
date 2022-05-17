<?php

namespace App\DataTables;

use App\Models\BusinessPaymentMethod;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class BusinessPaymentMethodDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'business_payment_methods.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BusinessPaymentMethod $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BusinessPaymentMethod $model)
    {
        return $model->newQuery()->with('businesses')->with('master_payment_methods');
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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
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
            'id_usaha' => new \Yajra\DataTables\Html\Column([
                'data'  => 'businesses.nama_usaha',
                'title' => 'Usaha'
            ]),
            'id_metode_pembayaran' => new \Yajra\DataTables\Html\Column([
                'data'  => 'master_payment_methods.nama_metode_pembayaran',
                'title' => 'Metode Pembayaran'
            ]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'business_payment_methods_datatable_' . time();
    }
}