<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortResource extends JsonResource
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
            'dst'       => $this->dst,
            'to'        => $this->to,
            'vpn'       => new VpnResource($this->whenLoaded('vpn')),
        ];
    }
}
