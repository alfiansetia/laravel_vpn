<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
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
            'id'            => $this->id,
            'DT_RowId'      => $this->dst,
            'name'          => $this->name,
            'acc_name'      => $this->acc_name,
            'acc_number'    => $this->acc_number,
            'is_active'     => $this->is_active,
        ];
    }
}
