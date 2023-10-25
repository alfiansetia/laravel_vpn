<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Server;
use App\Models\Vpn;
use App\Traits\CompanyTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class VpnController extends Controller
{
    use CompanyTrait;

    public function index(Request $request)
    {
        $comp = $this->getCompany();
        if ($request->ajax()) {
            $data = Vpn::query();
            if ($request->filled('username')) {
                $data->where('username', 'like', "%{$request->username}%");
            }
            if (isAdmin()) {
                $data->with('user', 'server');
            } else {
                $data->where('user_id', '=', auth()->id())->with('server:id,name,ip,domain,netwatch,location,price,is_active,is_trial');
            }
            $result = $data->get();
            return DataTables::of($data)->toJson();
        }
        if (isAdmin()) {
            return view('vpn.index', compact(['comp']))->with('title', 'Data Vpn');
        } else {
            return view('vpn.user', compact(['comp']))->with('title', 'Data Vpn');
        }
    }

    public function create(Request $request)
    {
        $comp = $this->getCompany();
        return view('vpn.create', compact(['comp']))->with('title', 'Order Vpn');
    }

    public function autoCreate(Request $request)
    {
        $user = $this->getUser();
        $count_trial = Vpn::where('user_id', '=', $user->id)->where('is_trial', '=', 'yes')->count();
        $count_free = Vpn::with('server')->where('user_id', '=', $user->id)->whereRelation('server', 'type', '=', 'free')->count();
        if (isAdmin()) {
            $count_trial = 0;
            $count_free = 0;
        }
        if ($count_trial > 0) {
            $data = ['message' => 'Trial Sudah Ada, Silahkan Selesaikan Pembayaran Dahulu Untuk membuat Trial Lagi!', 'data' => ''];
        } elseif ($count_free > 0) {
            $data = ['message' => 'Free Akun Sudah Ada, Satu User hanya mendapat 1 Free Akun !', 'data' => ''];
        } else {
            $this->validate($request, [
                'vpn'       => '',
                'server'    => [
                    'required',
                    'integer',
                    Rule::exists('servers', 'id')->where(function ($query) {
                        $query->where('is_active', 'yes');
                    }),
                ],
                'username'  => 'required|string|max:50|min:4|unique:vpns,username,' . $request->username . ',id,server_id,' . $request->input('server'),
                'password'  => 'required|string|max:50|min:4',
            ]);
            $reg = date('Y-m-d');
            $exp = date('Y-m-d', strtotime('+1 day', strtotime($reg)));
            $server = Server::find($request->input('server'));
            if ($server->is_active == 'yes') {
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

                $ip = ($server->ip . ($server->port != 0 ? (':' . $server->port) : ''));
                $u = $server->account->username;
                $p = decrypt($server->account->password);
                $free = date('Y-m-d', strtotime("+$server->time_free month", time()));

                if ($server->api == true) {
                    $param = [
                        'server'    => [
                            'ip'    => $ip,
                            'user'  => $u,
                            'pass'  => $p,
                            'netw'  => $netw
                        ],
                        'data'      => [
                            'user'      => $request->input('username'),
                            'pass'      => $request->input('password'),
                            'ip'        => $jadi,
                            'exp'       => $server->paid == 1 ? $exp : $free,
                            'is_active' => 1,
                        ],
                        'dst' => $dst,
                        'to' => $to,
                    ];
                    $createApi = Vpn::createApi($param);
                } else {
                    $createApi['status'] = true;
                }

                if ($createApi['status'] === true) {
                    $vpn = Vpn::create([
                        'user_id'   => Auth::id(),
                        'server_id' => $request->input('server'),
                        'username'  => $request->input('username'),
                        'password'  => $request->input('password'),
                        'ip'        => $jadi,
                        'regist'    => $reg,
                        'masa'      => $server->paid == 1 ? 0 : $server->time_free,
                        'expired'   => $server->paid == 1 ? $exp : $free,
                        'is_active' => 1,
                    ]);
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
                    if ($vpn) {
                        $data = ['message' => 'Success Insert Data', 'data' => ''];
                    } else {
                        $data = ['message' => 'Failed Insert Data', 'data' => ''];
                    }
                } else {
                    $data = $createApi;
                }
            } else {
                $data = ['message' => 'Server Nonactive', 'data' => ''];
            }
        }
        return response()->json($data);
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
                    $server = Server::where('id', $value)->where('is_active', 'yes')->first();
                    if (!$server) {
                        $fail('The selected server is not active.');
                    }
                }
            ],
            'username'     => 'required|max:50|min:4|unique:vpns,username,' . $request->input('username') . ',id,server_id,' . $request->input('server'),
            'password'     => 'required|max:50|min:4',
            'ip'           => 'required|ip|unique:vpns,ip,' . $request->input('ip') . ',id,server_id,' . $request->input('server'),
            'regist'       => 'required|date_format:Y-m-d',
            'is_active'    => 'required|in:yes,no',
            'sync'         =>  [
                'required',
                'in:yes,no',
                function ($attribute, $value, $fail) use ($request) {
                    $server = Server::find($request->input('server'));
                    if ($server->api == 'active') {
                        $serverApiActive = true;
                    } else {
                        $serverApiActive = false;
                    }
                    if ($value === 'yes' && !$serverApiActive) {
                        $fail('API Server OFF! Sync can only be "yes" when API server is active.');
                    }
                },
            ],
        ]);
        $masa = $request->input('masa') ?? 0;
        $regist = Carbon::parse($request->regist)->format('Y-m-d');
        if ($masa == '' || $masa < 1) {
            $exp = Carbon::parse($regist)->addDay()->format('Y-m-d');
        } else {
            $exp = Carbon::parse($regist)->addMonths($masa)->format('Y-m-d');
        }

        $createApi['status'] = true;
        if ($request->sync == 'yes') {
            $server = Server::find($request->input('server'));
            $ip = ($server->ip . ($server->port != 0 ? (':' . $server->port) : ''));
            $u = $server->username;
            $p = decrypt($server->password);
            $param = [
                'server'    => [
                    'ip'    => $ip,
                    'user'  => $u,
                    'pass'  => $p,
                    'netw'  => $server->netwatch
                ],
                'data'      => [
                    'user'      => $request->input('username'),
                    'pass'      => $request->input('password'),
                    'ip'        => $request->input('ip'),
                    'is_active' => $request->input('is_active'),
                    'exp'       => $exp,
                ]
            ];
            $createApi = Vpn::createApiManual($param);
        }

        if ($createApi['status']) {
            $vpn = Vpn::create([
                'user_id'   => $request->input('email'),
                'server_id' => $request->input('server'),
                'username'  => $request->input('username'),
                'password'  => $request->input('password'),
                'ip'        => $request->input('ip'),
                'regist'    => $regist,
                'masa'      => $masa ?? 0,
                'expired'   => $exp,
                'is_active' => $request->input('is_active'),
            ]);
            if ($vpn) {
                $data = ['message' => 'Success Insert Data', 'data' => ''];
            } else {
                $data = ['message' => 'Failed Insert Data', 'data' => ''];
            }
        } else {
            $data = $createApi;
        }
        return response()->json($data);
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
            'email'     => 'required|exists:users,id',
            'server'    => [
                'required',
                'integer',
                'exists:servers,id',
                function ($attribute, $value, $fail) {
                    $server = Server::where('id', $value)->where('is_active', 'yes')->first();
                    if (!$server) {
                        $fail('The selected server is not active.');
                    }
                }
            ],
            'username'      => 'required|max:50|min:4|unique:vpns,username,' . $vpn->id . ',id,server_id,' . $request->input('server'),
            'password'      => 'required|max:50|min:4',
            'ip'            => 'required|ip|unique:vpns,ip,' . $vpn->id . ',id,server_id,' . $request->input('server'),
            'regist'        => 'required|date_format:Y-m-d',
            'is_active'     => 'required|in:yes,no',
            'sync'          =>  [
                'required',
                'in:yes,no',
                function ($attribute, $value, $fail) use ($request) {
                    $server = Server::find($request->input('server'));
                    if ($server->api == 'active') {
                        $serverApiActive = true;
                    } else {
                        $serverApiActive = false;
                    }
                    if ($value === 'yes' && !$serverApiActive) {
                        $fail('API Server OFF! Sync can only be "yes" when API server is active.');
                    }
                },
            ],
        ]);
        $masa = $request->input('masa') ?? 0;
        $regist = Carbon::parse($request->regist)->format('Y-m-d');
        if ($masa == '' || $masa < 1) {
            $exp = Carbon::parse($regist)->addDay()->format('Y-m-d');
        } else {
            $exp = Carbon::parse($regist)->addMonths($masa)->format('Y-m-d');
        }

        $updateApi['status'] = true;
        if ($request->sync == 'yes') {
            $vpn = Vpn::with('server', 'port')->find($vpn->id);
            $param = [
                'vpn' => $vpn,
                'data'      => [
                    'user'      => $request->input('username'),
                    'pass'      => $request->input('password'),
                    'ip'        => $request->input('ip'),
                    'exp'       => $exp,
                    'is_active' => $request->input('is_active')
                ]
            ];
            $updateApi = Vpn::updateApi($param);
        }
        if ($updateApi['status'] === true) {
            $vpn->update([
                'user_id'   => $request->input('email'),
                'server_id' => $request->input('server'),
                'username'  => $request->input('username'),
                'password'  => $request->input('password'),
                'ip'        => $request->input('ip'),
                'regist'    => $regist,
                'masa'      => $masa ?? 0,
                'expired'   => $exp,
                'is_active' => $request->input('is_active'),
            ]);
            if ($vpn) {
                $data = ['message' => 'Success Update Data', 'data' => ''];
            } else {
                $data = ['message' => 'Failed Update Data', 'data' => ''];
            }
        } else {
            $data = $updateApi;
        }
        return response()->json($data);
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

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|array|min:1'
        ]);
        $deleted = 0;
        foreach ($request->id as $id) {
            $vpn = Vpn::with('server')->findOrFail($id);
            if ($vpn->server->is_active == 'yes' && $vpn->server->api == 'active') {
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
                        'user'  => $vpn->username,
                        'pass'  => $vpn->password,
                    ],
                ];
                $api = Vpn::deleteApi($param);
                if ($api['status'] === true) {
                    $deleted++;
                    $vpn->delete();
                } else {
                    $data = $api;
                }
            }
        }
        $data = ['message' => 'Success Delete : ' . $deleted . ' & Fail : ' . (count($request->id) - $deleted), 'data' => ''];
        return response()->json($data);
    }
}
