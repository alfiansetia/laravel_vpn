<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerProfileResource extends JsonResource
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
            '.id'                       => $this['.id'],
            'name'                      => $this['name'],
            'hotspot-address'           => $this['hotspot-address'],
            'dns-name'                  => $this['dns-name'],
            'html-directory'            => $this['html-directory'],
            'html-directory-override'   => $this['html-directory-override'],
            'rate-limit'                => $this['rate-limit'],
            'http-proxy'                => $this['http-proxy'],
            'smtp-server'               => $this['smtp-server'],
            'login-by'                  => $this['login-by'],
            'split-user-domain'         => ($this['split-user-domain'] ?? false) == "true" ? true : false,
            'use-radius'                => ($this['use-radius'] ?? false) == "true" ? true : false,
            'radius-accounting'         => ($this['radius-accounting'] ?? false) == "true" ? true : false,
            'nas-port-type'             => $this['nas-port-type'] ?? null,
            'radius-default-domain'     => $this['radius-default-domain'] ?? null,
            'radius-location-id'        => $this['radius-location-id'] ?? null,
            'radius-location-name'      => $this['radius-location-name'] ?? null,
            'radius-mac-format'         => $this['radius-mac-format'] ?? null,
            'default'                   => ($this['default'] ?? false) == "true" ? true : false,
        ];
    }
}
