<?php

namespace App\Http\Resources\Mikapi\PPP;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'address-list'          => $this['address-list'] ?? null,
            'bridge'                => $this['bridge'] ?? null,
            'bridge-horizon'        => $this['bridge-horizon'] ?? 0,
            'bridge-learning'       => $this['bridge-learning'] ?? 'default',
            'bridge-path-costs'     => $this['bridge-path-costs'] ?? 0,
            'bridge-port-priority'  => $this['bridge-port-priority'] ?? null,
            'change-tcp-mss'        => $this['change-tcp-mss'] ?? 'default',
            'comment'               => $this['comment'] ?? null,
            'default'               => ($this['default'] ?? false) == "true" ? true : false,
            'dns-server'            => $this['dns-server'] ?? null,
            'idle-timeout'          => $this['idle-timeout'] ?? null,
            'incoming-filter'       => $this['incoming-filter'] ?? null,
            'insert-queue-before'   => $this['insert-queue-before'] ?? null,
            'interface-list'        => $this['interface-list'] ?? 'none',
            'local-address'         => $this['local-address'] ?? null,
            'name'                  => $this['name'],
            'on-down'               => $this['on-down'] ?? null,
            'on-up'                 => $this['on-up'] ?? null,
            'only-one'              => $this['only-one'] ?? 'default',
            'outgoing-filter'       => $this['outgoing-filter'] ?? null,
            'parent-queue'          => $this['parent-queue'] ?? 'none',
            'queue-type'            => $this['queue-type'] ?? null,
            'rate-limit'            => $this['rate-limit'] ?? null,
            'remote-address'        => $this['remote-address'] ?? null,
            'session-timeout'       => $this['session-timeout'] ?? null,
            'use-compression'       => $this['use-compression'] ?? 'default',
            'use-encryption'        => $this['use-encryption'] ?? 'default',
            'use-mpls'              => $this['use-mpls'] ?? 'default',
            'use-upnp'              => $this['use-upnp'] ?? 'default',
            'wins-server'           => $this['wins-server'] ?? null,
        ];
    }
}
