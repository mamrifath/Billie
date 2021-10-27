<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyCreateController extends Controller
{

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required',
            'company_email' => 'required',
            'company_mobile_no' => 'required',
            'company_status' => 'required',
            'company_total_limit' => 'required',
        ]);

        $company = (new CompanyRepository)->create($request->all());
        return new CompanyResource($company);
    }
}
