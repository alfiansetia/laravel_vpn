<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'id'        => $this->id,
            'DT_RowId'  => $this->id,
            'date'      => $this->date,
            'number'    => $this->number,
            'total'     => $this->total,
            'from'      => $this->from,
            'to'        => $this->to,
            'status'    => $this->status,
            'image'     => $this->image,
            'desc'      => $this->desc,
            'vpn_id'    => $this->vpn_id,
            'user_id'   => $this->user_id,
            'bank_id'   => $this->bank_id,
            'vpn'       => new VpnResource($this->whenLoaded('vpn')),
            'user'      => new UserResource($this->whenLoaded('user')),
            'bank'      => new BankResource($this->whenLoaded('bank')),
        ];
    }
}
