<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            '.id'           => $this['.id'],
            'server'        => $this['server'],
            'user'          => $this['user'],
            'address'       => $this['address'],
            'mac-address'   => $this['mac-address'],
            'login-by'      => $this['login-by'],
            'uptime'        => $this['uptime'],
            'idle-time'     => $this['idle-time'] ?? null,
            'session-time-left' => $this['session-time-left'] ?? null,
            'keepalive-timeout' => $this['keepalive-timeout'] ?? null,
            'bytes-in'      => (int) $this['bytes-in'] ?? '0',
            'bytes-out'     => (int) $this['bytes-out'] ?? '0',
            'packets-in'    => (int) $this['packets-in'] ?? '0',
            'packets-out'   => (int) $this['packets-out'] ?? '0',
            'radius'        => $this['radius'] == 'true' ? true : false,
            'comment'       => $this['comment'] ?? null,
        ];
    }
}
