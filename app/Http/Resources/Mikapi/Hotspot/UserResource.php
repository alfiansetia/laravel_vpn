<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'bytes-in'          => (int) ($this['bytes-in'] ?? '0'),
            'bytes-out'         => (int) ($this['bytes-out'] ?? '0'),
            'comment'           => $this['comment'] ?? null,
            'default'           => ($this['default'] ?? false) == "true" ? true : false,
            'disabled'          => ($this['disabled'] ?? false) == "true" ? true : false,
            'dynamic'           => ($this['dynamic'] ?? false) == "true" ? true : false,
            'email'             => $this['email'] ?? null,
            'limit-bytes-in'    => (int) ($this['limit-bytes-in'] ?? '0'),
            'limit-bytes-out'   => (int) ($this['limit-bytes-out'] ?? '0'),
            'limit-bytes-total' => (int) ($this['limit-bytes-total'] ?? '0'),
            'limit-uptime'      => $this['limit-uptime'] ?? null,
            'mac-address'       => $this['mac-address'] ?? null,
            'name'              => $this['name'],
            'packets-in'        => (int) ($this['packets-in'] ?? '0'),
            'packets-out'       => (int) ($this['packets-out'] ?? '0'),
            'password'          => $this['password'] ?? null,
            'profile'           => $this['profile'] ?? null,
            'routes'            => $this['routes'] ?? null,
            'server'            => $this['server'] ?? 'all',
            'uptime'            => $this['uptime'] ?? null,
            'limit_uptime_parse' => !empty($this['limit-uptime'] ?? null) ? formatDTM($this['limit-uptime']) : null,
            'limit_byte_total_parse' => formatBytes((int) ($this['limit-bytes-total'] ?? '0')),
        ];
    }
}
