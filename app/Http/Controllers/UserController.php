<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    private $comp;

    public function __construct()
    {
        $this->middleware('roleAdmin');
        $this->comp = Company::first();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            if ($request->filled('email')) {
                $data->where('email', 'like', "%{$request->email}%");
            }
            $result = $data->get();
            return DataTables::of($result)->toJson();
        }
        $comp = $this->comp;
        return view('user.index', compact(['comp']))->with('title', 'Data User');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email',
            'gender'    => 'required|in:Male,Female',
            'phone'     => 'required|max:15|min:3',
            'address'   => 'required|max:100|min:3',
            'password'  => 'required',
            'role'      => 'required|in:Admin,User'
        ]);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
        ]);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Insert Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Insert Data', 'data' => '']);
        }
    }

    public function show(Request $request, User $user)
    {
        if ($request->ajax()) {
            return response()->json(['status' => true, 'message' => '', 'data' => $user]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'gender'    => 'required|in:Male,Female',
            'phone'     => 'required|max:15|min:3',
            'address'   => 'required|max:100|min:3',
            'role'      => 'required|in:Admin,User'
        ]);
        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'role'          => $request->role,
        ]);
        if ($user) {
            return response()->json(['status' => true, 'message' => 'Success Update Data', 'data' => '']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed Update Data', 'data' => '']);
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1'
        ]);
        $deleted = 0;
        foreach ($request->id as $id) {
            $user = User::findOrFail($id);
            $user->delete();
            if ($user) {
                $deleted++;
            }
        }
        $data = ['status' => true, 'message' => 'Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted), 'data' => ''];
        return response()->json($data);
    }
}
