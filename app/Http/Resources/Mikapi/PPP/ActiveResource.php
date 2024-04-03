<?php

namespace App\Http\Resources\Mikapi\PPP;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActiveResource extends JsonResource
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
            'address'               => $this['address'] ?? null,
            'caller-id'             => $this['caller-id'] ?? null,
            'comment'               => $this['comment'] ?? null,
            'encoding'              => $this['encoding'] ?? null,
            'limit-bytes-in'        => (int) ($this['limit-bytes-in'] ?? '0'),
            'limit-bytes-out'       => (int)($this['limit-bytes-out'] ?? '0'),
            'local'                 => ($this['local'] ?? false) == "true" ? true : false,
            'name'                  => $this['name'] ?? null,
            'radius'                => ($this['radius'] ?? false) == "true" ? true : false,
            'service'               => $this['service'] ?? 'any',
            'session-id'            => $this['session-id'] ?? null,
            'uptime'                => $this['uptime'] ?? null,
        ];
    }
}
