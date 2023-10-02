<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'hsname'    => $this->hsname,
            'dnsname'   => $this->dnsname,
            'desc'      => $this->desc,
            'user'      => new UserResource($this->whenLoaded('user')),
            'port'      => new PortResource($this->whenLoaded('port')),
        ];
    }
}
