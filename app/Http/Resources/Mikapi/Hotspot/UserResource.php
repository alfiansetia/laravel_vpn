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
            '.id'           => $this['.id'],
            'name'          => $this['name'],
            'server'        => $this['server'] ?? 'all',
            'password'      => $this['password'] ?? null,
            'address'       => $this['address'] ?? null,
            'mac-address'   => $this['mac-address'] ?? null,
            'profile'       => $this['profile'] ?? null,
            'uptime'        => $this['uptime'] ?? null,
            'limit-uptime'  => $this['limit-uptime'] ?? null,
            'bytes-in'      => (int) $this['bytes-in'] ?? '0',
            'bytes-out'     => (int) $this['bytes-out'] ?? '0',
            'packets-in'    => (int) $this['packets-in'] ?? '0',
            'packets-out'   => (int) $this['packets-out'] ?? '0',
            'default'       => ($this['default'] ?? false) == "true" ? true : false,
            'dynamic'       => ($this['dynamic'] ?? false) == "true" ? true : false,
            'disabled'      => ($this['disabled'] ?? false) == "true" ? true : false,
            'comment'       => $this['comment'] ?? null,
        ];
    }
}
