<?php

namespace App\Services\Mikapi\Hotspot;

use App\Services\RouterApiServices;

class UserServices extends RouterApiServices
{
    private $name = 'hotspot';
    private $command = '/ip/hotspot/user/';

    public function get(array $query = [])
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "print", $query);
                return handle_data($data);
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function show(string $id)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "print", [
                    '?.id' => $id
                ]);
                return handle_data_edit($data);
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function store($param)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "add", [
                    'server'             => $param->input('server'),
                    'name'               => $param->name,
                    'password'           => $param->password,
                    'address'            => $param->ip_address ?? '0.0.0.0',
                    'mac-address'        => $param->mac ?? '00:00:00:00:00:00',
                    'profile'            => $param->profile,
                    'limit-uptime'       => $param->data_day == null ? $param->time_limit : ($param->data_day . 'd ' . $param->time_limit),
                    'limit-bytes-total'  => $param->data_limit == null ? '0' : ($param->data_limit . $param->data_type),
                    'comment'            => $param->comment,
                    'disabled'           => $param->is_active == 1 ? 'no' : 'yes',
                ]);
                return handle_data($data, 'Success Insert Data!');
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function update($id, $param)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "set", [
                    '.id'                => $id,
                    'server'             => $param->input('server'),
                    'name'               => $param->name,
                    'password'           => $param->password,
                    'address'            => $param->ip_address ?? '0.0.0.0',
                    'mac-address'        => $param->mac ?? '00:00:00:00:00:00',
                    'profile'            => $param->profile,
                    'limit-uptime'       => $param->data_day == null ? $param->time_limit : ($param->data_day . 'd ' . $param->time_limit),
                    'limit-bytes-total'  => $param->data_limit == null ? '0' : ($param->data_limit . $param->data_type),
                    'comment'            => $param->comment,
                    'disabled'           => $param->is_active == 1 ? 'no' : 'yes',
                ]);
                return handle_data($data, 'Success Update Data!');
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function destroy(string $id)
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "remove", [
                    '.id' => $id
                ]);
                return handle_data($data, 'Success deleted data!');
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }
}
