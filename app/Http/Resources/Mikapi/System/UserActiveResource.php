<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserActiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'DT_RowId'  => $this['.id'],
            '.id'       => $this['.id'],
            'address'   => $this['address'] ?? '0.0.0.0',
            'by-romon'  => ($this['by-romon'] ?? false) == "true" ? true : false,
            'group'     => $this['group'] ?? null,
            'name'      => $this['name'] ?? null,
            'radius'    => ($this['radius'] ?? false) == "true" ? true : false,
            'via'       => $this['via'] ?? 'unknown',
            'when'      => $this['when'] ?? null,
        ];
    }
}
