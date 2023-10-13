<?php

namespace App\Http\Resources\Mikapi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterfaceResource extends JsonResource
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
            'default-name'      => $this['default-name'] ?? null,
            'type'              => $this['type'],
            'link-down'         => (int) ($this['link-down'] ?? '0'),
            'rx-byte'           => (int) ($this['rx-byte'] ?? '0'),
            'tx-byte'           => (int) ($this['tx-byte'] ?? '0'),
            'rx-packet'         => (int) ($this['rx-packet'] ?? '0'),
            'tx-packet'         => (int) ($this['tx-packet'] ?? '0'),
            'last-link-up-time' => $this['last-link-up-time'] ?? null,
            'mac-address'       => $this['mac-address'] ?? null,
            'dynamic'           => ($this['dynamic'] ?? false) == "true" ? true : false,
            'running'           => ($this['running'] ?? false) == "true" ? true : false,
            'disabled'          => ($this['disabled'] ?? false) == "true" ? true : false,
            'comment'           => $this['comment'] ?? null,
        ];
    }
}
