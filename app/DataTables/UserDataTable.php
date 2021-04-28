<?php

namespace App\DataTables;

use DB;
use Lang;
use App\Models\User;
use App\Services\DataTablesDefaults;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\DataTables\Datatables
     */
    public function dataTable()
    {
        $users = User::select(
            "users.*",
            DB::raw("(
                        SELECT roles.display_name
                        FROM roles
                        LEFT JOIN model_has_roles ON model_has_roles.role_id = roles.id
                        WHERE model_has_roles.model_id = users.id
                    ) as readable_role_name"),
            DB::raw("(CASE
                        WHEN users.is_active=true  THEN 'Sim'
                        WHEN users.is_active=false THEN 'Não'
                        ELSE NULL
                    END) as readable_is_active"),
        );

        return DataTables::of($users)
            ->filterColumn("readable_role_name", function ($query, $keyword) {
                $query->whereRaw("(
                                    SELECT roles.display_name
                                    FROM roles
                                    LEFT JOIN model_has_roles ON model_has_roles.role_id = roles.id
                                    WHERE model_has_roles.model_id = users.id
                                ) like ?", ["%{$keyword}%"]);
            })
            ->filterColumn("readable_is_active", function ($query, $keyword) {
                $query->whereRaw("(CASE
                                    WHEN users.is_active=true  THEN 'Sim'
                                    WHEN users.is_active=false THEN 'Não'
                                    ELSE NULL
                                END) like ?", ["%{$keyword}%"]);
            })
            ->addColumn("action", "users.datatables_actions")
            ->rawColumns(["action"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->minifiedAjax()
            ->columns($this->getColumns())
            ->addAction(["width" => "75px", "printable" => false, "title" => Lang::get("datatables.action")])
            ->parameters(DataTablesDefaults::getParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            "name"               => ["name" => "name",               "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => Lang::get("attributes.name")],
            "email"              => ["name" => "email",              "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => Lang::get("attributes.email")],
            "readable_role_name" => ["name" => "readable_role_name", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => Lang::get("attributes.role_name")],
            "readable_is_active" => ["name" => "readable_is_active", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => Lang::get("attributes.is_active")],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return Lang::choice("tables.users", "p")." ".date("d.m.Y H\hi\m");
    }
}
