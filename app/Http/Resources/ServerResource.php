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
            'id'            => $this->id,
            'DT_RowId'      => $this->id,
            'name'          => $this->name,
            'ip'            => $this->ip,
            'domain'        => $this->domain,
            'netwatch'      => $this->netwatch,
            'location'      => $this->location,
            'price'         => $this->price,
            'annual_price'  => $this->annual_price,
            'is_active'     => $this->is_active,
            'is_available'  => $this->is_available,
            $this->mergeWhen(isAdmin(), [
                'sufiks'    => $this->sufiks,
                'port'      => $this->port,
                'last_ip'   => $this->last_ip,
                'username'  => $this->username,
            ]),
        ];
    }
}
