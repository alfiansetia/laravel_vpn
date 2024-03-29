<?php

namespace App\Traits;

use Yajra\DataTables\DataTables;

trait DataTableTrait
{

    private function callback(array $data, bool $datatable = false)
    {
        if ($datatable) {
            return DataTables::of($data)->toJson();
        } else {
            return response()->json(['data' => $data]);
        }
    }
}
