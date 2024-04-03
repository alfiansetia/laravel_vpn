<?php

namespace App\Http\Resources\Mikapi\System\Routerboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'blocked'                   => ($this['blocked'] ?? false) == "true" ? true : false,
            'auto-upgrade'              => ($this['auto-upgrade'] ?? false) == "true" ? true : false,
            'baud-rate'                 => $this['baud-rate'] ?? null,
            'boot-delay'                => $this['boot-delay'] ?? null,
            'enter-setup-on'            => $this['enter-setup-on'] ?? null,
            'boot-device'               => $this['boot-device'] ?? null,
            'cpu-frequency'             => $this['cpu-frequency'] ?? null,
            'boot-protocol'             => $this['boot-protocol'] ?? null,
            'enable-jumper-reset'       => ($this['enable-jumper-reset'] ?? false) == "true" ? true : false,
            'force-backup-booter'       => ($this['force-backup-booter'] ?? false) == "true" ? true : false,
            'silent-boot'               => ($this['silent-boot'] ?? false) == "true" ? true : false,
            'protected-routerboot'      => $this['protected-routerboot'] ?? null,
            'reformat-hold-button'      => $this['reformat-hold-button'] ?? null,
            'reformat-hold-button-max'  => $this['reformat-hold-button-max'] ?? null,
        ];
    }
}
