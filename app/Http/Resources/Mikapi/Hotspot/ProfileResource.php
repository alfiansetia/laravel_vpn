<?php

namespace App\Http\Resources\Mikapi\Hotspot;

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
        return [
            '.id'               => $this['.id'],
            'name'              => $this['name'],
            'shared-users'      => $this['shared-users'],
            'rate-limit'        => $this['rate-limit'] ?? null,
            'session-timeout'   => $this['session-timeout'] ?? null,
            'default'           => ($this['default'] ?? false) == "true" ? true : false,
        ];
    }
}
