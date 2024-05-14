<?php

namespace App\Http\Controllers;

use App\Models\VoucherTemplate;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VoucherTemplateController extends Controller
{
    use CrudTrait;
    public function __construct()
    {
        $this->middleware('is.admin');
        $this->model = VoucherTemplate::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VoucherTemplate::query()->get();
            return DataTables::of($query)->toJson();
        }
        return view('template.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user'      => 'nullable|exists:users,id',
            'name'      => 'required|max:200',
            'html_up'   => 'required|max:65535',
            'html_vc'   => 'required|max:65535',
        ]);
        $user = auth()->user();
        $vc = VoucherTemplate::create([
            'user_id'   => $user->is_admin() ?  $request->user : $user->id,
            'name'      => $request->name,
            'html_up'   => $request->html_up,
            'html_vc'   => $request->html_vc,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $vc]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VoucherTemplate $template)
    {
        $this->validate($request, [
            'user'      => 'nullable|exists:users,id',
            'name'      => 'required|max:200',
            'html_up'   => 'required|max:65535',
            'html_vc'   => 'required|max:65535',
        ]);
        $user = auth()->user();
        $template->update([
            'user_id'   => $user->is_admin() ?  $request->user : $user->id,
            'name'      => $request->name,
            'is_active' => $request->is_active == 'on' ? 'yes' : 'no',
            'html_up'   => $request->html_up,
            'html_vc'   => $request->html_vc,
        ]);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }

    public function edit(VoucherTemplate $template)
    {
        $data = $template;
        return view('tes', compact('data'));
    }
}
