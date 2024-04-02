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
            'DT_RowId'      => $this['.id'],
            '.id'           => $this['.id'],
            'address'       => $this['address'] ?? null,
            'blocked'       => ($this['blocked'] ?? false) == 'true' ? true : false,
            'bypassed'      => ($this['bypassed'] ?? false) == 'true' ? true : false,
            'comment'       => $this['comment'] ?? null,
            'disabled'      => ($this['disabled'] ?? false) == 'true' ? true : false,
            'mac-address'   => $this['mac-address'] ?? null,
            'server'        => $this['server'] ?? 'all',
            'to-address'    => $this['to-address'] ?? null,
            'type'          => $this['type'] ?? 'regular'
        ];
    }
}
