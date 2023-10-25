<?php

namespace App\Traits;

use App\Models\Company;

trait CompanyTrait
{
    protected $comp;

    private function getCompany()
    {
        return $this->comp ?? Company::first();
    }
}
