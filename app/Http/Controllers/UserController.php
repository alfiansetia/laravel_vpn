<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CompanyTrait;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use CrudTrait, CompanyTrait;


    public function __construct()
    {
        $this->middleware('is.admin');
        $this->model = User::class;
    }

    public function paginate(Request $request)
    {
        $perpage = 10;
        if ($request->filled('perpage') && $request->perpage > 10 && is_numeric($request->perpage)) {
            $perpage = $request->perpage;
        }
        $data = User::query();
        if ($request->filled('email')) {
            $data->where('email', 'like', "%{$request->email}%");
        }
        $result = $data->paginate($perpage);
        return $result;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            if ($request->filled('email')) {
                $data->where('email', 'like', "%{$request->email}%");
            }
            $result = $data;
            return DataTables::of($result)->toJson();
        }
        return view('user.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email',
            'gender'    => 'required|in:male,female',
            'phone'     => 'required|max:15|min:3',
            'address'   => 'required|max:100|min:3',
            'password'  => 'required',
            'role'      => 'required|in:admin,user',
            'status'    => 'nullable|in:on',
            'verified'  => 'nullable|in:on',
        ]);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'status'    => $request->status == 'on' ? 'active' : 'nonactive',
            'email_verified_at' => $request->verified == 'on' ? now() : null,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'gender'    => 'required|in:male,female',
            'phone'     => 'required|max:15|min:3',
            'address'   => 'required|max:100|min:3',
            'role'      => 'required|in:admin,user',
            'status'    => 'nullable|in:on',
            'password'  => 'nullable|min:5',
            'verified'  => 'nullable|in:on',
        ]);
        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'role'      => $request->role,
            'status'    => $request->status == 'on' ? 'active' : 'nonactive',
            'email_verified_at' => null,
        ];
        if ($user->email_verified_at != null && $request->verified == 'on') {
            $data['email_verified_at'] = now();
        }
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
