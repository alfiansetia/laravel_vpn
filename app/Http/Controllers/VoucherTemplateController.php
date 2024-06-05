<?php

namespace App\Http\Controllers;

use App\Models\VoucherTemplate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VoucherTemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('is.admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VoucherTemplate::query();
            return DataTables::eloquent($query)->toJson();
        }
        return view('template.index');
    }

    public function edit(VoucherTemplate $template)
    {
        $data = $template;
        return view('tes', compact('data'));
    }
}
