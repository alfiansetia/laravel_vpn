<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\Setting;

trait CompanyTrait
{
    protected $setting;
    protected $comp;
    protected $user;

    private function getCompany()
    {
        return $this->comp ?? Company::first();
    }

    private function getUser()
    {
        return $this->user ?? auth()->user();
    }

    private function getSetting()
    {
        return $this->setting ?? (Setting::first() ?? Setting::factory()->create());
    }
}
