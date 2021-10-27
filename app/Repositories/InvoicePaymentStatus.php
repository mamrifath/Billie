<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoicePaymentStatus
{
    public function status(array $data)
    {
        $paidStatus = DB::table('invoices')
            ->where('id', data_get($data, 'invoice_id'))
            ->update(['status' => data_get($data, 'status')]);
        return $paidStatus;
    }
}
