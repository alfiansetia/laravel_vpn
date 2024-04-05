<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $items = explode(',', $this['policy']);
        $policy = [];
        foreach ($items as $item) {
            $policy[str_replace('!', '', $item)] = strpos($item, '!') === 0 ? false : true;
        }
        return [
            'DT_RowId'  => $this['.id'],
            '.id'       => $this['.id'],
            'comment'   => $this['comment'] ?? null,
            'name'      => $this['name'],
            'skin'      => $this['skin'] ?? 'default',
            'system'    => ($this['system'] ?? false) == "true" ? true : false,
            'policy'    => $this['policy'],
            'policies'  => $policy,
        ];
    }
}
