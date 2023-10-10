<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    private $comp;
    public function __construct()
    {
        $this->middleware('roleAdmin')->only(['company', 'companyupdate']);
        $this->comp = Company::first();
    }

    public function company()
    {
        return view('setting.company')->with([
            'title' => 'Setting Company',
            'comp' => $this->comp,
        ]);
    }

    public function companyupdate(Request $request)
    {
        $comp = Company::first();
        if ($request->logo == '') {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'address'   => 'required|min:3|max:200',
            ]);
        } else {
            $this->validate($request, [
                'name'      => 'required|min:3|max:50',
                'phone'     => 'required|min:3|max:15',
                'address'   => 'required|min:3|max:200',
                'logo'      => 'required|mimes:jpg,jpeg,png,svg|max:10240',
            ]);
        }

        if ($request->logo == '') {
            $comp->update([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
            ]);
        } else {
            File::delete(public_path('assets/img/logo/' . $comp->logo));
            $file = $request->file('logo');
            $name = 'logo.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/logo'), $name);
            $comp->update([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'logo'      => $name,
            ]);
        }
        if ($comp) {
            return redirect()->route('setting.company')->with(['success' => 'Success Update Company!']);
        } else {
            return redirect()->route('setting.company')->with(['error' => 'Failed Update Company!']);
        }
    }

    public function profile()
    {
        $comp = $this->comp;
        return view('setting.profile', compact(['comp']))->with('title', 'Setting Profile');
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
        if ($user) {
            return redirect()->route('setting.profile')->with(['success' => 'Success Update Profile!']);
        } else {
            return redirect()->route('setting.profile')->with(['error' => 'Failed Update Profile!']);
        }
    }

    public function password()
    {
        $comp = $this->comp;
        return view('setting.password', compact(['comp']))->with('title', 'Setting Password');
    }

    public function passwordUpdate(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'password'  => ['required', 'same:password2', Password::min(8)->numbers()],
            'password2' => 'required',
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
