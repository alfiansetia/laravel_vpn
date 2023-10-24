<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            '.id'               => $this['.id'],
            'name'              => $this['name'],
            'group'             => $this['group'],
            'address'           => $this['address'],
            'last-logged-in'    => $this['last-logged-in'] ?? null,
            'comment'           => $this['comment'] ?? null,
            'disabled'          => $this['disabled'] == 'true' ? true : false,
        ];
    }
}
