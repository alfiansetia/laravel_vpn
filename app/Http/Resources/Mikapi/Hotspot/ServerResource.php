<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            '.id'               => $this['.id'],
            'HTTPS'             => ($this['HTTPS'] ?? false) == "true" ? true : false,
            'address-pool'      => $this['address-pool'] ?? null,
            'addresses-per-mac' => (int) $this['addresses-per-mac'] ?? '0',
            'disabled'          => ($this['disabled'] ?? false) == "true" ? true : false,
            'idle-timeout'      => $this['idle-timeout'] ?? null,
            'interface'         => $this['interface'] ?? null,
            'invalid'           => ($this['invalid'] ?? false) == "true" ? true : false,
            'ip-of-dns-name'    => $this['ip-of-dns-name'] ?? null,
            'keepalive-timeout' => $this['keepalive-timeout'] ?? null,
            'login-timeout'     => $this['login-timeout'] ?? null,
            'name'              => $this['name'],
            'profile'           => $this['profile'] ?? null,
            'proxy-status'      => $this['proxy-status'] ?? null,
        ];
    }
}
