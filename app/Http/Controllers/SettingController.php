<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    private $comp;
    private $base_url_telegram = 'https://api.telegram.org/';
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

    public function telegram()
    {
        $setting = Setting::first();
        $comp = $this->comp;
        if (!$setting) {
            $setting = Setting::factory()->create();
        }
        return view('setting.telegram', compact(['setting', 'comp']))->with('title', 'Setting Telegram');
    }

    public function telegramUpdate(Request $request)
    {
        $this->validate($request, [
            'telegram_token'    => 'required',
            'telegram_bot_name' => 'required',
            'telegram_group_id' => 'required',
        ]);
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::factory()->create();
        }
        $setting->update([
            'telegram_token'    => $request->telegram_token,
            'telegram_bot_name' => $request->telegram_bot_name,
            'telegram_group_id' => $request->telegram_group_id,
        ]);
        if ($setting) {
            return redirect()->route('setting.telegram')->with(['success' => 'Success Update Telegram!']);
        } else {
            return redirect()->route('setting.telegram')->with(['error' => 'Failed Update Telegram!']);
        }
    }

    public function telegramSet(Request $request)
    {
        $this->validate($request, [
            'action'    => 'required|in:set,unset,info',
        ]);
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::factory()->create();
        }
        $botToken = $setting->telegram_token;
        if ($request->action === 'info') {
            return $this->getInfoWebhook($botToken);
        } elseif ($request->action === 'set') {
            return $this->setWebhook($botToken);
        } else {
            return $this->unSetWebhook($botToken);
        }
    }

    private function setWebhook(string $token)
    {
        $client = new Client();
        $url_webhook = url("api/telegram/$token/webhook");
        $url = $this->base_url_telegram . "bot{$token}/setWebhook?url=$url_webhook";
        try {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $webhookInfo = json_decode($response->getBody());
                return response()->json(['data' => $webhookInfo, 'message' => $webhookInfo->description]);
            } else {
                return response()->json(['message' => 'Error get Webhook Info!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Request! ' . $e->getMessage()], 500);
        }
    }

    private function unSetWebhook(string $token)
    {
        $client = new Client();
        $url = $this->base_url_telegram . "bot{$token}/deleteWebhook";
        try {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $webhookInfo = json_decode($response->getBody());
                return response()->json(['data' => $webhookInfo, 'message' => $webhookInfo->description]);
            } else {
                return response()->json(['message' => 'Error get Webhook Info!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Request! ' . $e->getMessage()], 500);
        }
    }

    private function getInfoWebhook(string $token)
    {
        $client = new Client();
        $url = $this->base_url_telegram . "bot{$token}/getWebhookInfo";
        try {
            $response = $client->get($url);
            if ($response->getStatusCode() == 200) {
                $webhookInfo = json_decode($response->getBody());
                return response()->json(['data' => $webhookInfo, 'message' => '']);
            } else {
                return response()->json(['message' => 'Error get Webhook Info!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Request!' . $e->getMessage()], 500);
        }
    }
}
