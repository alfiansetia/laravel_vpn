<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
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
            'ip'        => $this->ip,
            'domain'    => $this->domain,
            'netwatch'  => $this->netwatch,
            'location'  => $this->location,
            'price'     => $this->price,
            'is_active' => $this->is_active,
            'time_free' => $this->time_free,
            'type'      => $this->type,
        ];
    }
}
