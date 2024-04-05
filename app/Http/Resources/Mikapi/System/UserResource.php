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
            'DT_RowId'          => $this['.id'],
            '.id'               => $this['.id'],
            'address'           => $this['address'] ?? null,
            'comment'           => $this['comment'] ?? null,
            'disabled'          => ($this['disabled'] ?? false) == "true" ? true : false,
            'group'             => $this['group'] ?? null,
            'last-logged-in'    => $this['last-logged-in'] ?? null,
            'name'              => $this['name'],
            // 'password'          => $this['password'] ?? null,
        ];
    }
}
