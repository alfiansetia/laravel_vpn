<?php

namespace App\Traits;

use App\Models\Company;

trait CompanyTrait
{
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
}
