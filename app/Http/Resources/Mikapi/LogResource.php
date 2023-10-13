<?php

namespace App\Http\Resources\Mikapi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
            '.id'       => $this['.id'],
            'time'      => $this['time'],
            'topics'    => $this['topics'],
            'message'   => $this['message'],
        ];
    }
}
