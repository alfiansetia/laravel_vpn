<?php

namespace App\Http\Resources\Mikapi\PPP;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SecretResource extends JsonResource
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
            '.id'                       => $this['.id'],
            'caller-id'                 => $this['caller-id'] ?? null,
            'comment'                   => $this['comment'] ?? null,
            'disabled'                  => ($this['disabled'] ?? false) == "true" ? true : false,
            'ipv6-routes'               => $this['ipv6-routes'] ?? null,
            'last-caller-id'            => $this['last-caller-id'] ?? null,
            'last-disconnect-reason'    => $this['last-disconnect-reason'] ?? null,
            'last-logged-out'           => $this['last-logged-out'] ?? null,
            'limit-bytes-in'            => (int) ($this['limit-bytes-in'] ?? '0'),
            'limit-bytes-out'           => (int)($this['limit-bytes-out'] ?? '0'),
            'local-address'             => $this['local-address'] ?? null,
            'name'                      => $this['name'],
            'password'                  => $this['password'] ?? null,
            'profile'                   => $this['profile'] ?? null,
            'remote-address'            => $this['remote-address'] ?? null,
            'routes'                    => $this['routes'] ?? null,
            'service'                   => $this['service'] ?? 'any',
        ];
    }
}
