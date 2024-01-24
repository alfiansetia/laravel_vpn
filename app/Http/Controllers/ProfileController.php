<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    use CompanyTrait;

    public function profile()
    {
        $orders = Order::with('bank')->where('user_id', $this->getUser()->id)->get();
        return view('setting.profile', compact('orders'));
    }

    public function profileEdit()
    {
        return view('setting.profile.profile_edit');
    }

    public function profileUpdate(Request $request)
    {
        $user = $this->getUser();
        $this->validate($request, [
            'name'      => 'required|max:25|min:3',
            'gender'    => 'in:male,female',
            'phone'     => 'required|max:25|min:3',
            'address'   => 'required|max:100|min:3',
        ]);
        $user->Update([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);
        if ($user) {
            return redirect()->route('setting.profile.edit')->with(['success' => 'Success Update Profile!']);
        } else {
            return redirect()->route('setting.profile.edit')->with(['error' => 'Failed Update Profile!']);
        }
    }

    public function social()
    {
        return view('setting.profile.social');
    }

    public function socialUpdate(Request $request)
    {
        $user = $this->getUser();
        $this->validate($request, [
            'instagram' => 'required|max:30|min:3',
            'facebook'  => 'required|max:30|min:3',
            'linkedin'  => 'required|max:30|min:3',
            'github'    => 'required|max:30|min:3',
        ]);
        $user->Update([
            'instagram' => $request->instagram,
            'facebook'  => $request->facebook,
            'linkedin'  => $request->linkedin,
            'github'    => $request->github,
        ]);
        if ($user) {
            return redirect()->route('setting.social')->with(['success' => 'Success Update Profile!']);
        } else {
            return redirect()->route('setting.social')->with(['error' => 'Failed Update Profile!']);
        }
    }

    public function password()
    {
        return view('setting.profile.password');
    }

    public function passwordUpdate(Request $request)
    {
        $user = $this->getUser();
        $this->validate($request, [
            'password'  => ['required', 'same:password_confirmation', Password::min(8)->numbers()],
            'password_confirmation' => 'required',
        ]);
        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('setting.password')->with(['error' => "Password can't be the same as before!"]);
        } else {
            $user = $user->Update([
                'password'     => Hash::make($request->password),
            ]);
            if ($user) {
                return redirect()->route('setting.password')->with(['success' => 'Success Update Password!']);
            } else {
                return redirect()->route('setting.password')->with(['error' => 'Failed Update Password!']);
            }
        }
    }
}
