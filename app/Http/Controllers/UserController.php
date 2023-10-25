<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CompanyTrait;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use CrudTrait, CompanyTrait;


    public function __construct()
    {
        $this->middleware('roleAdmin');
        $this->model = User::class;
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
        $comp = $this->getCompany();
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
            'role'      => 'required|in:Admin,User',
            'verified'  => 'nullable|in:on,off',
        ]);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'gender'    => $request->gender,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'email_verified_at' => $request->verified === 'on' ? now() : null,
        ]);
        return response()->json(['message' => 'Success Insert Data', 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'gender'    => 'required|in:Male,Female',
            'phone'     => 'required|max:15|min:3',
            'address'   => 'required|max:100|min:3',
            'role'      => 'required|in:Admin,User',
            'password'  => 'nullable|min:5',
            'verified'  => 'nullable|in:on,off',
        ]);
        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'role'          => $request->role,
            'email_verified_at' => $request->verified === 'on' ? now() : null,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return response()->json(['message' => 'Success Update Data', 'data' => '']);
    }
}
