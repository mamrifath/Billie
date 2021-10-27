<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\InvoiceResource;
use App\Repositories\InvoiceRepository;

class InvoiceController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required',
            'invoice_from' => 'required',
            'invoice_to' => 'required',
            'invoice_items' => 'required',
        ]);

        if (DB::table('companies')->where('id', data_get($request, 'company_id'))->doesntExist()) {
            $errorResponse =  [
                'code' => '200',
                'message' => 'Company not exist',
                'error' => 'The requested company is not exist',
            ];
            return $errorResponse;
        } else {
            $invoiceTotal = 0;
            $companyData = DB::table('companies')->where('id', data_get($request, 'company_id'))->first();
            $invoiceData = DB::table('invoices')
                ->where('company_id', 1)
                ->where('status', 0)
                ->get();

            foreach ($invoiceData as $data) {
                $invoiceTotal = $invoiceTotal + $data->invoice_total;
            }

            $invoiceCreatedTotal = $this->invoiceTotalExceededVerification(data_get($request, 'invoice_items'));
            $invoiceTotalBefore = $invoiceCreatedTotal + $invoiceTotal;
            // print  $companyData->company_total_limit . " - " . $invoiceTotal . " - " . $invoiceCreatedTotal . " - " . $invoiceTotalBefore;
            if ($companyData->company_total_limit <= $invoiceTotalBefore) {
                $errorResponse =  [
                    'code' => '200',
                    'message' => 'Limit Exceeded !',
                    'error' => 'Invoice Limit has been Exceeded',
                ];
                return $errorResponse;
            }
            $invoice = (new InvoiceRepository)->create($request->all());
            return new InvoiceResource($invoice);
        }
    }

    public function invoiceTotalExceededVerification(array $data)
    {
        $total = 0;
        foreach ($data as $items) {
            $invoiceTotal = $items['quantity'] * $items['unit_price'];
            $total = $total + $invoiceTotal;
        }
        return $total;
    }
}
