<?php

namespace App\Services;

use Lang;

class DataTablesDefaults
{
    public static function getParameters($params = [])
    {
        $defaults =  [
            'language' => [
                'paginate' => [
                    'next'          => Lang::get('datatables.next'),
                    'previous'      => Lang::get('datatables.previous')
                ],
                'buttons' => [
                    'pageLength'    => Lang::get('datatables.page_length')
                ],
                'search'            => '',
                'searchPlaceholder' => Lang::get('datatables.search'),
                'emptyTable'        => Lang::get('datatables.empty_table'),
                'info'              => Lang::get('datatables.info'),
                'infoEmpty'         => Lang::get('datatables.info_empty'),
                'infoFiltered'      => Lang::get('datatables.info_filtered'),
                'loadingRecords'    => Lang::get('datatables.loading_records'),
                'processing'        => Lang::get('datatables.processing'),
                'zeroRecords'       => Lang::get('datatables.zero_records')
            ],
            'dom' => 'Bfrtip',
            'order' => [
                [0, 'asc']
            ],
            'pageLength' => 25,
            'scrollX' => true,
            'buttons' => [
                [
                    'extend' => 'print',
                    'text' => Lang::get('datatables.print'),
                    'exportOptions' => [
                        'modifier' => [
                            'search' => 'applied',
                            'order' => 'applied'
                        ]
                    ]
                ],
                [
                    'extend' => 'collection',
                    'fade' => 200,
                    'text' => Lang::get('datatables.collection'),
                    'buttons' => [
                        [
                            'extend' => 'csv',
                            'text' => Lang::get('datatables.csv'),
                            'exportOptions' => [
                                'modifier' => [
                                    'search' => 'applied',
                                    'order' => 'applied'
                                ]
                            ]
                        ],
                        [
                            'extend' => 'excel',
                            'text' => Lang::get('datatables.excel'),
                            'exportOptions' => [
                                'modifier' => [
                                    'search' => 'applied',
                                    'order' => 'applied'
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'extend' => 'reload',
                    'text' => Lang::get('datatables.reload')
                ],
                [
                    'extend' => 'colvis',
                    'fade' => 200,
                    'text' => Lang::get('datatables.colvis')
                ],
                [
                    'extend' => 'pageLength',
                    'fade' => 200,
                ]
            ]
        ];

        foreach ($params as $key => $value) {
            $defaults[$key] = $value;
        }

        return $defaults;
    }
}
