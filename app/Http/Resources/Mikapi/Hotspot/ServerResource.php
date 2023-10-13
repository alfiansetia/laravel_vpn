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
            'name'              => $this['name'],
            'interface'         => $this['interface'] ?? null,
            'address-pool'      => $this['address-pool'] ?? null,
            'profile'           => $this['profile'] ?? null,
            'idle-timeout'      => $this['idle-timeout'] ?? null,
            'addresses-per-mac' => (int) $this['addresses-per-mac'] ?? '0',
            'invalid'           => ($this['invalid'] ?? false) == "true" ? true : false,
            'HTTPS'             => ($this['HTTPS'] ?? false) == "true" ? true : false,
            'disabled'          => ($this['disabled'] ?? false) == "true" ? true : false,
        ];
    }
}
