<?php

namespace App\Http\Resources\Mikapi\System;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
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
            'uptime'            => $this['uptime'],
            'version'           => $this['version'],
            'build-time'        => $this['build-time'],
            'factory-software'  => $this['factory-software'] ?? null,
            'free-memory'       => (int) ($this['free-memory'] ?? '0'),
            'total-memory'      => (int) ($this['total-memory'] ?? '0'),
            'cpu'               => $this['cpu'],
            'cpu-count'         => (int) ($this['cpu-count'] ?? '0'),
            'cpu-frequency'     => (int) ($this['cpu-frequency'] ?? '0'),
            'cpu-load'          => (int) ($this['cpu-load'] ?? '0'),
            'free-hdd-space'    => (int) ($this['free-hdd-space'] ?? '0'),
            'total-hdd-space'   => (int) ($this['total-hdd-space'] ?? '0'),
            'architecture-name' => $this['architecture-name'] ?? null,
            'board-name'        => $this['board-name'] ?? null,
            'platform'          => $this['platform'] ?? null,
        ];
    }
}
