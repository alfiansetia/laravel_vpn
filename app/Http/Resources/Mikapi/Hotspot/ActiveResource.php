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
            'DT_RowId'          => $this['.id'],
            '.id'               => $this['.id'],
            'address'           => $this['address'] ?? null,
            'advertisement'     => $this['advertisement'] ?? null,
            'blocked'           => ($this['blocked'] ?? false) == "true" ? true : false,
            'bytes-in'          => (int) ($this['bytes-in'] ?? '0'),
            'bytes-out'         => (int) ($this['bytes-out'] ?? '0'),
            'comment'           => $this['comment'] ?? null,
            'domain'            => $this['domain'] ?? null,
            'idle-time'         => $this['idle-time'] ?? null,
            'idle-timeout'      => $this['idle-timeout'] ?? null,
            'keepalive-timeout' => $this['keepalive-timeout'] ?? null,
            'limit-bytes-in'    => (int) ($this['limit-bytes-in'] ?? '0'),
            'limit-bytes-out'   => (int)($this['limit-bytes-out'] ?? '0'),
            'limit-bytes-total' => (int)($this['limit-bytes-total'] ?? '0'),
            'login-by'          => $this['login-by'] ?? null,
            'mac-address'       => $this['mac-address'] ?? null,
            'packets-in'        => (int) ($this['packets-in'] ?? '0'),
            'packets-out'       => (int) ($this['packets-out'] ?? '0'),
            'radius'            => ($this['radius'] ?? false) == "true" ? true : false,
            'server'            => $this['server'] ?? 'all',
            'session-time-left' => $this['session-time-left'] ?? null,
            'uptime'            => $this['uptime'],
            'user'              => $this['user'],
        ];
    }
}
