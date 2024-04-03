<?php

namespace App\Http\Resources\Mikapi\DHCP;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeasesResource extends JsonResource
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
            'DT_RowId'                  => $this['.id'],
            '.id'                       => $this['.id'] ?? null,
            'active-address'            => $this['active-address'] ?? null,
            'active-client-id'          => $this['active-client-id'] ?? null,
            'active-mac-address'        => $this['active-mac-address'] ?? null,
            'active-server'             => $this['active-server'] ?? null,
            'address'                   => $this['address'] ?? null,
            'address-lists'             => $this['address-lists'] ?? null,
            'agent-circuit-id'          => $this['agent-circuit-id'] ?? null,
            'agent-remote-id'           => $this['agent-remote-id'] ?? null,
            'allow-dual-stack-queue'    => ($this['allow-dual-stack-queue'] ?? false) == "true" ? true : false,
            'always-broadcast'          => ($this['always-broadcast'] ?? false) == "true" ? true : false,
            'block-access'              => ($this['block-access'] ?? false) == "true" ? true : false,
            'blocked'                   => ($this['blocked'] ?? false) == "true" ? true : false,
            'client-id'                 => $this['client-id'] ?? null,
            'comment'                   => $this['comment'] ?? null,
            'dhcp-option'               => $this['dhcp-option'] ?? null,
            'dhcp-option-set'           => $this['dhcp-option-set'] ?? null,
            'disabled'                  => ($this['disabled'] ?? false) == "true" ? true : false,
            'dynamic'                   => ($this['dynamic'] ?? false) == "true" ? true : false,
            'expires-after'             => $this['expires-after'] ?? null,
            'host-name'                 => $this['host-name'] ?? null,
            'insert-queue-before'       => $this['insert-queue-before'] ?? null,
            'last-seen'                 => $this['last-seen'] ?? null,
            'lease-time'                => $this['lease-time'] ?? null,
            'mac-address'               => $this['mac-address'] ?? null,
            'radius'                    => ($this['radius'] ?? false) == "true" ? true : false,
            'rate-limit'                => $this['rate-limit'] ?? null,
            'server'                    => $this['server'] ?? null,
            'src-mac-address'           => $this['src-mac-address'] ?? null,
            'status'                    => $this['status'] ?? null,
            'use-src-mac'               => ($this['use-src-mac'] ?? false) == "true" ? true : false,
        ];
    }
}
