<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profile()
    {
        return new UserResource(auth()->user());
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'gender'    => 'in:Male,Female',
            'phone'     => 'required|max:25|min:3',
            'address'   => 'required|max:100|min:3',
        ]);
        $user->Update([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);
        return response()->json(['message' => 'Success Update Profile!']);
    }

    public function passwordUpdate(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'current_password'  => [
                'required',
                function ($attribute, $value, $fail) use ($request, $user) {
                    if (!Hash::check($request->current_password, $user->password)) {
                        $fail('Current password is incorrect.');
                    }
                }
            ],
            'new_password'      => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return response()->json(['message' => 'Password updated successfully.']);
    }
}
