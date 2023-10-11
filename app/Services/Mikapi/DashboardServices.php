<?php

namespace App\Services\Mikapi;

use App\Services\RouterApiServices;

class DashboardServices extends RouterApiServices
{
    public function get()
    {
        if ($this->connect()) {
            $packages = $this->API->comm("/system/package/print");
            $resource = $this->API->comm("/system/resource/print");
            $routerboard = $this->API->comm("/system/routerboard/print");
            $hs_active = 0;
            $hs_user = 0;
            $ppp_active = 0;
            $ppp_secret = 0;

            if (cek_package($packages, 'hotspot')) {
                $hs_active = $this->API->comm("/ip/hotspot/active/print", [
                    'count-only' => ''
                ]);
                if (is_error($hs_active)) {
                    $hs_active = 0;
                }
                $hs_user = $this->API->comm("/ip/hotspot/user/print", [
                    'count-only' => ''
                ]);
                if (is_error($hs_user)) {
                    $hs_user = 0;
                }
            }
            if (cek_package($packages, 'ppp')) {
                $ppp_active = $this->API->comm("/ppp/active/print", [
                    'count-only' => ''
                ]);
                if (is_error($ppp_active)) {
                    $ppp_active = 0;
                }
                $ppp_secret = $this->API->comm("/ppp/secret/print", [
                    'count-only' => ''
                ]);
                if (is_error($ppp_secret)) {
                    $ppp_secret = 0;
                }
            }
            $data = ['status' => true, 'message' => '', 'data' => [
                'resource'      => $resource,
                'package'       => $packages,
                'routerboard'   => $routerboard,
                'hs_active'     => $hs_active,
                'hs_user'       => $hs_user,
                'ppp_active'    => $ppp_active,
                'ppp_secret'    => $ppp_secret,
            ]];
            $this->disconnect();
            return $data;
        } else {
            return handle_fail_login($this->API);
        }
    }
}
