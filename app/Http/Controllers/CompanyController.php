<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\CompanyTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use CompanyTrait;

    private $base_url_telegram = 'https://api.telegram.org/';

    public function __construct()
    {
        $this->middleware('is.admin');
    }

    public function general()
    {
        return view('setting.company.general');
    }

    public function generalUpdate(Request $request)
    {
        $comp = $this->getCompany();
        // if ($request->logo == '') {
        $this->validate($request, [
            'name'      => 'required|min:3|max:50',
            'phone'     => 'required|min:3|max:15',
            'slogan'    => 'required|min:3|max:200',
            'address'   => 'required|min:3|max:200',
        ]);
        // } else {
        //     $this->validate($request, [
        //         'name'      => 'required|min:3|max:50',
        //         'phone'     => 'required|min:3|max:15',
        //         'address'   => 'required|min:3|max:200',
        //         'logo'      => 'required|mimes:jpg,jpeg,png,svg|max:10240',
        //     ]);
        // }

        // if ($request->logo == '') {
        $comp->update([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'slogan'    => $request->slogan,
            'address'   => $request->address,
        ]);
        // } else {
        //     File::delete(public_path('assets/img/logo/' . $comp->logo));
        //     $file = $request->file('logo');
        //     $name = 'logo.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('assets/img/logo'), $name);
        //     $comp->update([
        //         'name'      => $request->name,
        //         'phone'     => $request->phone,
        //         'address'   => $request->address,
        //         'logo'      => $name,
        //     ]);
        // }
        if ($comp) {
            return redirect()->route('setting.company.general')->with(['success' => 'Success Update Company!']);
        } else {
            return redirect()->route('setting.company.general')->with(['error' => 'Failed Update Company!']);
        }
    }

    public function image()
    {
        return view('setting.company.image');
    }

    public function imageUpdate(Request $request)
    {
        $this->validate($request, [
            'logo_light' => 'nullable|mimes:jpg,jpeg,png,svg|max:10240',
            'logo_dark'  => 'nullable|mimes:jpg,jpeg,png,svg|max:10240',
        ]);
        $comp = $this->getCompany();
        $logo_light  = $comp->getRawOriginal('logo_light');
        $logo_dark  = $comp->getRawOriginal('logo_dark');
        $path = public_path('images/logo/');
        $param = [];
        if ($files_light = $request->file('logo_light')) {
            if (!empty($logo_light) && file_exists($path . $logo_light)) {
                File::delete($path . $logo_light);
            }
            $logo_light = 'logo_' . date('dmyHis') . '.' . $files_light->getClientOriginalExtension();
            $files_light->move($path, $logo_light);
            $param['logo_light'] = $logo_light;
        }
        if ($files_dark = $request->file('logo_dark')) {
            if (!empty($logo_dark) && file_exists($path . $logo_dark)) {
                File::delete($path . $logo_dark);
            }
            $logo_dark = 'logo_' . date('dmyHis') . '.' . $files_dark->getClientOriginalExtension();
            $files_dark->move($path, $logo_dark);
            $param['logo_dark'] = $logo_dark;
        }
        $comp->update($param);
        if ($comp) {
            return redirect()->route('setting.company.image')->with(['success' => 'Success Update Image!']);
        } else {
            return redirect()->route('setting.company.image')->with(['error' => 'Nothing to update!']);
        }
    }

    public function social()
    {
        return view('setting.company.social');
    }

    public function socialUpdate(Request $request)
    {
        $comp = $this->getCompany();
        $this->validate($request, [
            'instagram' => 'required|max:30|min:3',
            'facebook'  => 'required|max:30|min:3',
            'linkedin'  => 'required|max:30|min:3',
            'github'    => 'required|max:30|min:3',
            'twitter'   => 'required|max:30|min:3',
            'blog'      => 'required|max:50|min:3',
            'status'    => 'required|max:150|min:3',
        ]);
        $comp->Update([
            'instagram'     => $request->instagram,
            'facebook'      => $request->facebook,
            'linkedin'      => $request->linkedin,
            'github'        => $request->github,
            'twitter'       => $request->twitter,
            'link_blog'     => $request->blog,
            'link_status'   => $request->status,
        ]);
        if ($comp) {
            return redirect()->route('setting.company.social')->with(['success' => 'Success Update Company!']);
        } else {
            return redirect()->route('setting.company.social')->with(['error' => 'Failed Update Company!']);
        }
    }
}
