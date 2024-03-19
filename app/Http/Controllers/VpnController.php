<?php

namespace App\Http\Controllers;

use App\Mail\DetailVpnMail;
use App\Models\Port;
use App\Models\Server;
use App\Models\Vpn;
use App\Services\ServerApiServices;
use App\Traits\CompanyTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class VpnController extends Controller
{
    use CompanyTrait;

    public function paginate(Request $request)
    {
        $perpage = 10;
        if ($request->filled('perpage') && $request->perpage > 10 && is_numeric($request->perpage)) {
            $perpage = $request->perpage;
        }
        $data = Vpn::query();
        if ($request->filled('username')) {
            $data->where('username', 'like', "%{$request->username}%");
        }
        $result = $data->paginate($perpage);
        return $result;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vpn::query();
            if ($request->filled('username')) {
                $data->where('username', 'like', "%{$request->username}%");
            }
            if ($request->filled('status')) {
                $data->where('is_active', '=', $request->status);
            }
            if ($request->filled('trial')) {
                $data->where('is_trial', '=', $request->trial);
            }
            if ($request->filled('dst') && is_numeric($request->dst) && $request->dst > 0) {
                $data->whereRelation('port', 'dst', '=', $request->dst);
            }
            if (isAdmin()) {
                $data->with('user', 'server');
            } else {
                $data->where('user_id', '=', auth()->id())->with('server:id,name,ip,domain,netwatch,location,price,is_active,is_trial');
            }
            $result = $data;
            return DataTables::of($result)->toJson();
        }
        if (isAdmin()) {
            return view('vpn.index');
        } else {
            return view('vpn.user');
        }
    }

    public function create(Request $request)
    {
        $servers = Server::where('is_active', 'yes')->where('is_available', 'yes')->get();
        return view('vpn.create_auto', compact('servers'));
    }

    public function autoCreate(Request $request)
    {
        $user = $this->getUser();
        $count_trial = Vpn::where('user_id', '=', $user->id)->where('is_trial', '=', 'yes')->count();
        if (isAdmin()) {
            $count_trial = 0;
        }
        if ($count_trial > 0) {
            return response()->json([
                'message'   => 'Trial Sudah Ada, Silahkan Selesaikan Pembayaran Dahulu Untuk membuat Trial Lagi!',
                'data'      => ''
            ], 403);
        }
        $this->validate($request, [
            'server'    => [
                'required',
                'integer',
                Rule::exists('servers', 'id')->where(function ($query) {
                    $query->where('is_active', 'yes')->where('is_available', 'yes');
                }),
            ],
            'username'  => [
                'required',
                'string',
                'max:50',
                'min:4',
                function ($attribute, $value, $fail) use ($request) {
                    $server = Server::find($request->input('server'));
                    if ($server) {
                        $vpn = Vpn::where('server_id', $server->id)
                            ->where('username', (generateUsername($value) . ($server->sufiks ?? '')))->first();
                        if ($vpn) {
                            $fail('Username is invalid!');
                        }
                    }
                },
            ],
            'password'  => 'required|string|max:50|min:4',
        ]);
        DB::beginTransaction();
        try {
            $server = Server::find($request->input('server'));
            $reg = date('Y-m-d');
            $exp = date('Y-m-d', strtotime('+1 day', strtotime($reg)));
            $service = new ServerApiServices($server);
            $netw = $server->netwatch;
            $last_ip = $server->last_ip;
            $last_count = $server->count_ip;
            $last_port = $server->last_port;
            $pecah = explode('.', $netw);

            if ($last_count >= 199) {
                $last_ip = $last_ip + 1;
                $last_count = 9;
                $last_port = $last_port + 1;
            }
            $portweb = 7000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
            $portapi = 8000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
            $portwin = 9000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
            $dst = [$portweb, $portapi, $portwin];
            $to = [80, 8728, 8291];
            $jadi = $pecah[0] . '.' . $pecah[1] . '.' . $last_ip . '.' . $last_count + 1;
            $username = generateUsername($request->input('username')) . $server->sufiks ?? '';
            $param =  [
                'user_id'   => $user->id,
                'server_id' => $request->input('server'),
                'username'  => $username,
                'password'  => $request->input('password'),
                'ip'        => $jadi,
                'expired'   => $exp,
                'is_active' => 'yes',
            ];
            $service->store($param, $dst);
            $vpn = Vpn::create($param);
            $server->update([
                'last_ip'   => $last_ip,
                'count_ip'  => $last_count + 1,
                'last_port' => $last_port,
            ]);
            for ($i = 0; $i < count($dst); $i++) {
                Port::create([
                    'vpn_id'    => $vpn->id,
                    'dst'       => $dst[$i],
                    'to'        => $to[$i],
                ]);
            }
            $data = ['message' => 'Success Insert Data', 'data' => ''];
            DB::commit();
            return response()->json($data);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|integer|exists:users,id',
            'server'    => [
                'required',
                'integer',
                'exists:servers,id',
                function ($attribute, $value, $fail) {
                    $server = Server::where('is_active', 'yes')->find($value);
                    if (!$server) {
                        $fail('The selected server is not active.');
                    }
                }
            ],
            'username'     => 'required|max:50|min:4|unique:vpns,username,' . $request->input('username') . ',id,server_id,' . $request->input('server'),
            'password'     => 'required|max:50|min:4',
            'ip'           => 'required|ip|unique:vpns,ip,' . $request->input('ip') . ',id,server_id,' . $request->input('server'),
            'expired'      => 'required|date_format:Y-m-d',
            'is_active'    => 'nullable|in:on',
            'sync'         => 'nullable|in:on',
        ]);
        DB::beginTransaction();
        try {
            $expired = Carbon::parse($request->expired)->format('Y-m-d');
            $param = [
                'user_id'   => $request->input('email'),
                'server_id' => $request->input('server'),
                'username'  => $request->input('username'),
                'password'  => $request->input('password'),
                'ip'        => $request->input('ip'),
                'expired'   => $expired,
                'is_active' => $request->input('is_active') == 'on' ? 'yes' : 'no',
            ];
            if ($request->sync == 'on') {
                $server = Server::find($request->input('server'));
                $service = new ServerApiServices($server);
                $service->store($param, []);
            }
            $vpn = Vpn::create($param);
            DB::commit();
            return response()->json(['message' => 'Success Insert Data', 'data' => '']);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed Insert Data : ' . $e->getMessage(), 'data' => ''], 500);
        }
    }

    public function show(Request $request, Vpn $vpn)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            if (isAdmin()) {
                $vpn = Vpn::with('user', 'server', 'port')->find($vpn->id);
            } else {
                $vpn = Vpn::where('user_id', '=', $user->id)->with('server:id,name,ip,domain,netwatch,location,price,is_active,paid', 'port')->find($vpn->id);
            }
            return response()->json([
                'status'    => true,
                'data'      => $vpn,
                'message'   => ''
            ]);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Vpn $vpn)
    {
        $this->validate($request, [
            'email'     => 'required|integer|exists:users,id',
            'username'      => 'required|max:50|min:4|unique:vpns,username,' . $vpn->id . ',id,server_id,' . $vpn->server_id,
            'password'      => 'required|max:50|min:4',
            'ip'            => 'required|ip|unique:vpns,ip,' . $vpn->id . ',id,server_id,' . $vpn->server_id,
            'expired'       => 'required|date_format:Y-m-d',
            'is_active'     => 'nullable|in:on',
            'sync'          => 'nullable|in:on',
        ]);
        $expired = $request->input('expired');
        try {
            $param = [
                'user_id'   => $request->input('email'),
                'username'  => $request->input('username'),
                'password'  => $request->input('password'),
                'ip'        => $request->input('ip'),
                'expired'   => $expired,
                'is_active' => $request->input('is_active') == 'on' ? 'yes' : 'no',
            ];
            if ($request->sync == 'on') {
                $service = $this->setServer($vpn);
                $service->update($vpn, $param);
            }
            $vpn->update($param);
            return response()->json(['message' => 'Success Update Data', 'data' => '']);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Failed Update Data : ' . $e->getMessage()], 500);
        }
    }

    public function monitor(Request $request)
    {
        if ($request->ajax()) {
            $data = Vpn::where('is_active', '=', 'yes')->where('expired', '<=', date('Y-m-d'))->get();
            $api = ['message' => 'No VPN Expired', 'data' => ''];
            foreach ($data as $d) {
                $vpn = Vpn::with('server')->findOrFail($d->id);
                $ip = ($vpn->server->ip . ($vpn->server->port != 0 ? (':' . $vpn->server->port) : ''));
                $u = $vpn->server->username;
                $p = decrypt($vpn->server->password);
                $param = [
                    'server'    => [
                        'ip'    => $ip,
                        'user'  => $u,
                        'pass'  => $p,
                    ],
                    'data'      => [
                        'user'      => $vpn->username,
                        'pass'      => $vpn->password,
                    ]
                ];
                $api = Vpn::disableApi($param);
                if ($api['status'] == true) {
                    $d->update([
                        'is_active' => 0
                    ]);
                }
            }
            return response()->json($api);
        } else {
            abort(404);
        }
    }

    public function destroy(Request $request, Vpn $vpn)
    {
        if ($request->ajax()) {
            try {
                $service = $this->setServer($vpn);
                $service->destroy($vpn);
                $vpn->delete();
                $data = ['message' => 'Success Delete Data!', 'data' => ''];
                return response()->json($data);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage()], 500);
            }
        } else {
            abort(404);
        }
    }

    public function destroyBatch(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'id'    => 'required|array|min:1',
                'id.*'  => 'required|integer|exists:' . Vpn::class . ',id',
            ]);
            // try {
            $deleted = 0;
            foreach ($request->id as $id) {
                $vpn = Vpn::find($id);
                if ($vpn) {
                    if ($vpn->server->is_active === 'yes') {
                        try {
                            $service = new ServerApiServices($vpn->server);
                            $service->destroy($vpn);
                            $vpn->delete();
                            $deleted++;
                        } catch (Exception $e) {
                            // return response()->json(['message' => $e->getMessage(), 500]);
                        }
                    }
                }
            }
            $data = ['message' => 'Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted), 'data' => ''];
            return response()->json($data);
            // } catch (Exception $e) {
            //     return response()->json(['message' => $e->getMessage()], 500);
            // }
        } else {
            abort(404);
        }
    }

    private function setServer(Vpn $vpn)
    {
        if (!$vpn->server->is_active === 'yes') {
            return response()->json(['message' => 'Server Nonactive!'], 403);
        }
        return new ServerApiServices($vpn->server);
    }

    public function sendEmail(Request $request, Vpn $vpn)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns'
        ]);
        $to = $request->email;
        try {
            Mail::to($to)->queue(new DetailVpnMail($vpn));
            return response()->json(['message' => 'Success Send Email to ' . $to]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Failed Send Email : ' . $th->getMessage()], 500);
        }
    }
}
