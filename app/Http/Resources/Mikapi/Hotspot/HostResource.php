<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return  parent::toArray($request);
        return [
            'DT_RowId'              => $this['.id'],
            '.id'                   => $this['.id'],
            'DHCP'                  => ($this['DHCP'] ?? false) == 'true' ? true : false,
            'address'               => $this['address'] ?? null,
            'authorized'            => ($this['authorized'] ?? false) == 'true' ? true : false,
            'bridge-port'           => $this['bridge-port'] ?? null,
            'bypassed'              => ($this['bypassed'] ?? false) == 'true' ? true : false,
            'bytes-in'              => (int) ($this['bytes-in'] ?? '0'),
            'bytes-out'             => (int) ($this['bytes-out'] ?? '0'),
            'comment'               => $this['comment'] ?? null,
            'dynamic'               => ($this['dynamic'] ?? false) == 'true' ? true : false,
            'found-by'              => $this['found-by'] ?? null,
            'host-dead-time'        => $this['host-dead-time'] ?? null,
            'http-proxy'            => $this['http-proxy'] ?? null,
            'idle-time'             => $this['idle-time'] ?? null,
            'idle-timeout'          => $this['idle-timeout'] ?? null,
            'keepalive-timeout'     => $this['keepalive-timeout'] ?? null,
            'mac-address'           => $this['mac-address'] ?? null,
            'packets-in'            => (int) ($this['packets-in'] ?? '0'),
            'packets-out'           => (int) ($this['packets-out'] ?? '0'),
            'server'                => $this['server'] ?? 'all',
            'static'                => ($this['static'] ?? false) == 'true' ? true : false,
            'to-address'            => $this['to-address'] ?? null,
            'uptime'                => $this['uptime'] ?? null,
            'vlan-id'               => $this['vlan-id'] ?? null,
        ];
    }
}
