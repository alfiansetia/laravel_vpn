<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VoucherTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherTemplateController extends Controller
{
    public function index()
    {
        $data = VoucherTemplate::all();
        return response()->json(['message' => '', 'data' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:50',
            'html_up' => 'required|max:65000',
            'html_vc' => 'required|max:65000',
        ]);

        $id = auth()->id();
        $vc = VoucherTemplate::create([
            'user_id'   => $id,
            'name'      => $request->name,
            'html_up'   => $request->html_up,
            'html_vc'   => $request->html_vc,
        ]);
        return response()->json(['message' => 'Success Insert Data!', 'data' => $vc]);
    }

    public function update(Request $request, VoucherTemplate $voucher)
    {
        $this->validate($request, [
            'name'      => 'required|max:50',
            'html_up'   => 'required|max:65000',
            'html_vc'   => 'required|max:65000',
        ]);
        $id = auth()->id();
        $voucher->update([
            'user_id'   => $id,
            'name'      => $request->name,
            'html_up'   => $request->html_up,
            'html_vc'   => $request->html_vc,
        ]);
        return response()->json(['message' => 'Success Update Data!', 'data' => $voucher]);
    }

    public function destroy(VoucherTemplate $voucher)
    {
        $voucher->delete();
        return response()->json(['message' => 'Success Delete Data!', 'data' => null]);
    }
}
