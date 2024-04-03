<?php

namespace App\Http\Resources\Mikapi\PPP;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class L2tpSecretResource extends JsonResource
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
            'address'               => $this['address'] ?? '0.0.0.0/0',
            'comment'               => $this['comment'] ?? null,
            'secret'                => $this['secret'] ?? null,
        ];
    }
}
