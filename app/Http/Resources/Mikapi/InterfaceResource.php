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
            'DT_RowId'              => $this['.id'],
            '.id'                   => $this['.id'],
            'comment'               => $this['comment'] ?? null,
            'default-name'          => $this['default-name'] ?? null,
            'disabled'              => ($this['disabled'] ?? false) == "true" ? true : false,
            'dynamic'               => ($this['dynamic'] ?? false) == "true" ? true : false,
            'fp-rx-byte'            => (int) ($this['fp-rx-byte'] ?? '0'),
            'fp-rx-packet'          => (int) ($this['fp-rx-packet'] ?? '0'),
            'fp-tx-byte'            => (int) ($this['fp-tx-byte'] ?? '0'),
            'fp-tx-packet'          => (int) ($this['fp-tx-packet'] ?? '0'),
            'invalid'               => ($this['invalid'] ?? false) == "true" ? true : false,
            'last-link-down-time'   => $this['last-link-down-time'] ?? null,
            'last-link-up-time'     => $this['last-link-up-time'] ?? null,
            'link-downs'            => (int) ($this['link-downs'] ?? '0'),
            'l2mtu'                 => (int) ($this['l2mtu'] ?? '0'),
            'mac-address'           => $this['mac-address'] ?? null,
            'max-l2mtu'             => $this['max-l2mtu'] ?? null,
            'mtu'                   => (int) ($this['mtu'] ?? '0'),
            'name'                  => $this['name'] ?? null,
            'running'               => ($this['running'] ?? false) == "true" ? true : false,
            'rx-byte'               => (int) ($this['rx-byte'] ?? '0'),
            'rx-drop'               => (int) ($this['rx-drop'] ?? '0'),
            'rx-error'              => (int) ($this['rx-error'] ?? '0'),
            'rx-packet'             => (int) ($this['rx-packet'] ?? '0'),
            'slave'                 => ($this['slave'] ?? false) == "true" ? true : false,
            'type'                  => $this['type'] ?? null,
            'tx-byte'               => (int) ($this['tx-byte'] ?? '0'),
            'tx-error'              => (int) ($this['tx-error'] ?? '0'),
            'tx-error'              => (int) ($this['tx-error'] ?? '0'),
            'tx-packet'             => (int) ($this['tx-packet'] ?? '0'),
            'tx-queue-drop'         => (int) ($this['tx-queue-drop'] ?? '0'),
        ];
    }
}
