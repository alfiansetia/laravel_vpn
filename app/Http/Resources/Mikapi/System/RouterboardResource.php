<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouterboardResource extends JsonResource
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
            'model'             => $this['model'] ?? null,
            'serial-number'     => $this['serial-number'] ?? null,
            'firmware-type'     => $this['firmware-type'] ?? null,
            'factory-firmware'  => $this['factory-firmware'] ?? null,
            'current-firmware'  => $this['current-firmware'] ?? null,
            'upgrade-firmware'  => $this['upgrade-firmware'] ?? null,
            'routerboard'       => $this['routerboard'] == 'true' ? true : false,
        ];
    }
}
