<?php

namespace App\Services\Mikapi;

use App\Services\RouterApiServices;

class LogServices extends RouterApiServices
{
    private $name = 'system';

    public function get()
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm("/log/print", [
                    '?topics' => 'hotspot,info,debug',
                ]);
                return handle_data($data);
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }

    public function getByTopics(array $topics = [])
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            if (cek_package($packages, $this->name)) {
                $data = $this->API->comm("/log/print", [
                    '?topics' => implode(',', $topics),
                ]);
                return handle_data($data);
            }
            $this->disconnect();
            return handle_no_package($this->name);
        } else {
            return handle_fail_login($this->API);
        }
    }
}
