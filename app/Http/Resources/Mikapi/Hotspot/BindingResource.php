<?php

namespace App\Http\Resources\Mikapi\Hotspot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BindingResource extends JsonResource
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
            '.id'           => $this['.id'],
            'mac-address'   => $this['mac-address'] ?? null,
            'address'       => $this['address'] ?? null,
            'to-address'    => $this['to-address'] ?? null,
            'server'        => $this['address'] ?? 'all',
            'disabled'      => ($this['disabled'] ?? false) == 'true' ? true : false,
            'comment'       => $this['comment'] ?? null,
            'type'          => $this['type'] ?? 'regular'
        ];
    }
}
