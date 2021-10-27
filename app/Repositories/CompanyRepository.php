<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function create(array $data)
    {
        $company = new Company;
        $company->company_name = data_get($data, 'company_name');
        $company->company_email = data_get($data, 'company_email');
        $company->company_mobile_no = data_get($data, 'company_mobile_no');
        $company->company_status = data_get($data, 'company_status');
        $company->company_info = data_get($data, 'company_info');
        $company->company_total_limit = data_get($data, 'company_total_limit');
        $company->save();
        return $company;
    }
}
