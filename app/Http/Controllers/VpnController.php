<?php

namespace App\Http\Controllers;

use App\Mail\DetailVpnMail;
use App\Models\BalanceHistory;
use App\Models\Port;
use App\Models\Server;
use App\Models\TemporaryIp;
use App\Models\Vpn;
use App\Services\ServerApiServices;
use App\Traits\CompanyTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        $result = $data->with('server:id,name')->paginate($perpage);
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
                $data->where('user_id', '=', auth()->id())->with('server:id,name,ip,domain,netwatch,location,price,is_active');
            }
            $result = $data->latest('id')->get();
            return DataTables::of($result)->toJson();
        }
        if (isAdmin()) {
            return view('vpn.index');
        } else {
            return view('vpn.index_user');
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
            $temp = TemporaryIp::where('server_id', $server->id)->first();
            $reg = date('Y-m-d');
            $exp = date('Y-m-d', strtotime('+1 day', strtotime($reg)));
            $to = [80, 8728, 8291];
            $netw = $server->netwatch;
            if ($temp) {
                $jadi = $temp->ip;
                $dst = [$temp->web, $temp->api, $temp->win];
            } else {
                $pecah_last_ip = explode('.', $server->last_ip);
                $pecah_netwatch = explode('.', $netw);
                $last_ip = $pecah_last_ip[2];
                $last_count = $pecah_last_ip[3];
                $last_port = $pecah_last_ip[2] - $pecah_netwatch[2] + 1;
                if ($last_count >= 199) {
                    $last_ip = $last_ip + 1;
                    $last_count = 9;
                    $last_port = $last_port + 1;
                }
                $portweb = 7000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
                $portapi = 8000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
                $portwin = 9000 + ($last_port * 100) + (($last_port - 1) * 100) + $last_count + 1;
                $dst = [$portweb, $portapi, $portwin];
                $jadi = $pecah_last_ip[0] . '.' . $pecah_last_ip[1] . '.' . $last_ip . '.' . $last_count + 1;
            }

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
            $service = new ServerApiServices($server);
            $service->store($param, $dst);
            $vpn = Vpn::create($param);
            if ($temp) {
                $temp->delete();
            } else {
                $server->update([
                    'last_ip'   => $jadi,
                ]);
            }
            for ($i = 0; $i < count($dst); $i++) {
                Port::create([
                    'vpn_id'    => $vpn->id,
                    'dst'       => $dst[$i],
                    'to'        => $to[$i],
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Success Insert Data', 'data' => $vpn]);
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
            'is_trial'     => 'nullable|in:on',
            'sync'         => 'nullable|in:on',
            'desc'         => 'nullable|max:200',
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
                'is_trial'  => $request->input('is_trial') == 'on' ? 'yes' : 'no',
                'desc'      => $request->input('desc'),
            ];
            if ($request->sync == 'on') {
                $server = Server::find($request->input('server'));
                $service = new ServerApiServices($server);
                $service->store($param, []);
            }
            $vpn = Vpn::create($param);
            DB::commit();
            return response()->json(['message' => 'Success Insert Data', 'data' => $vpn]);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed Insert Data : ' . $e->getMessage(), 'data' => ''], 500);
        }
    }

    public function show(Request $request, string $id)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            if ($user->is_admin()) {
                $vpn = Vpn::with('user', 'server', 'port')->find($id);
            } else {
                $vpn = Vpn::where('user_id', '=', $user->id)->with('server:id,name,ip,domain,netwatch,location,price,is_active', 'port')->find($id);
            }
            if (!$vpn) {
                return response()->json([
                    'data'      => null,
                    'message'   => 'Data Not Found!'
                ], 404);
            }
            return response()->json([
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
            'is_trial'      => 'nullable|in:on',
            'sync'          => 'nullable|in:on',
            'desc'          => 'nullable|max:200',
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
                'is_trial'  => $request->input('is_trial') == 'on' ? 'yes' : 'no',
                'desc'      => $request->input('desc'),
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

    public function analyze(Request $request, Vpn $vpn)
    {
        try {
            $service = $this->setServer($vpn);
            $data = $service->analyze($vpn);
            return response()->json([
                'message' => '',
                'data' => [
                    'on_server' => $data,
                    'on_db'     => $vpn,
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed : ' . $th->getMessage(),
                'data' => [
                    'on_server' => null,
                    'on_db'     => $vpn,
                ]
            ], 500);
        }
    }

    public function download(Request $request, Vpn $vpn)
    {
        $path = storage_path('app/files/vpn');
        $file_name = generateUsername($vpn->username) . '.rsc';
        $content = "/interface sstp-client add";
        $content .= " connect-to=\"" . $vpn->server->domain . "\" ";
        $content .= " name=\"$vpn->username\" ";
        $content .= " user=\"$vpn->username\" ";
        $content .= " password=\"$vpn->username\" ";
        $content .= " disabled=\"no\" ";
        $content .= " comment=\"<<==" . $vpn->server->domain . "==>\"; ";
        $content .= " /tool netwatch add host=\"192.168.168.1\"  ";
        $content .= " comment=\"<<==" . $vpn->server->domain . "==>\"; ";
        if (!File::exists($path)) {
            File::makeDirectory($path, 755, true);
        }
        File::put($path . '/' . $file_name, $content);
        return response()->file($path . '/' . $file_name)->deleteFileAfterSend();
    }

    public function extend(Request $request, Vpn $vpn)
    {
        $this->validate($request, [
            'amount' => 'required|in:1,2,3,4,5,6,12'
        ]);
        $user = auth()->user();
        if ($user->is_not_admin() && $vpn->user_id != $user->id) {
            return response()->json(['message' => 'This not your VPN!'], 403);
        }
        DB::beginTransaction();
        try {
            $user_balance = $user->balance;
            $month = $request->amount;
            $amount = $month * 10000;
            if ($month == 12) {
                $amount = $amount - 20000;
            }
            if ($user_balance < $amount) {
                throw new Exception('Your Balance Not Enough, Please topup!');
            }
            $vpn_expired = $vpn->expired;
            $new_expired = date('Y-m-d', strtotime("+$month month", strtotime($vpn_expired)));
            if ($vpn->is_expired()) {
                $new_expired = date('Y-m-d', strtotime("+$month month", time()));
            }
            $service = $this->setServer($vpn);
            $service->extend($vpn, $new_expired);
            $vpn->update([
                'expired'   => $new_expired,
                'is_active' => 'yes',
            ]);
            $user->update([
                'balance' => $user_balance - $amount,
            ]);
            BalanceHistory::create([
                'date'      => date('Y-m-d H:i:s'),
                'user_id'   => $user->id,
                'amount'    => $amount,
                'type'      => 'min',
                'before'    => $user_balance,
                'after'     => $user_balance - $amount,
                'desc'      => 'Extend ' . $vpn->username . ' ' . $month . ' Month',
            ]);
            DB::commit();
            return response()->json(['message' => 'Success Extend Vpn']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Failed Extend Vpn : ' . $th->getMessage()], 500);
        }
    }

    public function temporary(Request $request, Vpn $vpn)
    {
        DB::beginTransaction();
        try {
            $ports = $vpn->port;
            $count_port = count($ports ?? []);
            if ($count_port != 3) {
                throw new Exception('Vpn Not Suitable for move to temporary : port available ' . $count_port);
            }
            TemporaryIp::create([
                'server_id' => $vpn->server_id,
                'ip'        => $vpn->ip,
                'web'       => $ports[0]->dst,
                'api'       => $ports[1]->dst,
                'win'       => $ports[2]->dst,
            ]);
            $service = $this->setServer($vpn);
            $service->destroy($vpn);
            $vpn->delete();
            DB::commit();
            return response()->json(['message' => 'Success Move Vpn to Temporary!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Failed Move Vpn to Temporary : ' . $th->getMessage()], 500);
        }
    }
}
