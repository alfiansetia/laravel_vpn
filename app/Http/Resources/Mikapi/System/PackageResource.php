<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name'          => $this['name'],
            'version'       => $this['version'],
            'build-time'    => $this['build-time'],
            'scheduled'     => $this['scheduled'],
            'bundle'        => $this['bundle'] ?? null,
            'disabled'      => ($this['disabled'] ?? false) == "true" ? true : false,
        ];
    }
}
