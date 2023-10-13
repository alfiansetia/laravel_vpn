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
            '.id'           => $this['.id'],
            'address'       => $this['address'],
            'mac-address'   => $this['mac-address'],
            'to-address'    => $this['to-address'],
            'server'        => $this['server'] ?? 'all',
            'uptime'        => $this['uptime'],
            'idle-time'     => $this['idle-time'],
            'host-dead-time' => $this['host-dead-time'],
            'bytes-in'      => (int) ($this['bytes-in'] ?? '0'),
            'bytes-out'     => (int) ($this['bytes-out'] ?? '0'),
            'packets-in'    => (int) ($this['packets-in'] ?? '0'),
            'packets-out'   => (int) ($this['packets-out'] ?? '0'),
            'static'        => ($this['static'] ?? false) == 'true' ? true : false,
            'dynamic'       => ($this['dynamic'] ?? false) == 'true' ? true : false,
            'DHCP'          => ($this['DHCP'] ?? false) == 'true' ? true : false,
            'authorized'    => ($this['authorized'] ?? false) == 'true' ? true : false,
            'bypassed'      => ($this['bypassed'] == false) == 'true' ? true : false,
            'found-by'      => $this['found-by'] ?? null,
            'comment'       => $this['comment'] ?? null,
        ];
    }
}
