<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\InvoicePaymentStatus;

class InvoicePaymentStatusController extends Controller
{
    public function __invoke(Request $request)
    {
        if (DB::table('invoices')->where('id', data_get($request, 'invoice_id'))->doesntExist()) {
            $errorResponse =  [
                'code' => '200',
                'message' => 'Invoice not exist',
                'error' => 'The requested invoice is not exist',
            ];
            return $errorResponse;
        } else {
            $invoiceStatus = (new InvoicePaymentStatus)->status($request->all());

            $Response =  [
                'code' => '200',
                'message' => 'Success',
            ];
            return $Response;
        }
    }
}
