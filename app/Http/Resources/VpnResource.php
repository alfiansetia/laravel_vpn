<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VpnResource extends JsonResource
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
            'ip'        => $this->ip,
            'username'  => $this->username,
            'password'  => $this->password,
            'regist'    => $this->regist,
            'masa'      => $this->masa,
            'expired'   => $this->expired,
            'is_active' => $this->is_active,
            'user'      => new UserResource($this->whenLoaded('user')),
            'server'    => new ServerResource($this->whenLoaded('server')),
            'ports'     => PortResource::collection($this->whenLoaded('port')),
        ];
    }
}
