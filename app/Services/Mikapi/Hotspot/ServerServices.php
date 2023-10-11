<?php

namespace App\Services\Mikapi\Hotspot;

use App\Services\RouterApiServices;

class ServerServices extends RouterApiServices
{
    private $name = 'hotspot';
    private $command = '/ip/hotspot/';

    public function get()
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm($this->command . "print");
                return handle_data($data);
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function getById($id)
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
}
