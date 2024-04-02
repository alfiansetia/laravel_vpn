<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CookieResource extends JsonResource
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
            'DT_RowId'          => $this['.id'],
            '.id'               => $this['.id'],
            'domain'            => $this['domain'] ?? null,
            'expires-in'        => $this['expires-in'] ?? null,
            'mac-address'       => $this['mac-address'] ?? null,
            'mac-cookie'        => ($this['mac-cookie'] ?? false) == 'true' ? true : false,
            'user'              => $this['user'] ?? null,
        ];
    }
}
