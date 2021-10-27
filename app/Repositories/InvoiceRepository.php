<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    public function create(array $data)
    {

        /*
        **** Company Exist validation
        */


        $invoice = new Invoice;

        $invoiceItemsList = [];
        $total = 0;
        foreach ($data['invoice_items'] as $items) {
            $invoiceTotal = $items['quantity'] * $items['unit_price'];
            $invoiceItemsList[] = [
                'invoice_id' => $invoice->id,
                'description' => $items['description'],
                'quantity' => $items['quantity'],
                'unit_price' => $items['unit_price'],
            ];
            $total = $total + $invoiceTotal;
        }

        $invoice->company_id = data_get($data, 'company_id');
        $invoice->invoice_from = data_get($data, 'invoice_from');
        $invoice->invoice_to = data_get($data, 'invoice_to');
        $invoice->invoice_date = data_get($data, 'invoice_date');
        $invoice->invoice_type = data_get($data, 'invoice_type');
        $invoice->invoice_total = $total;
        $invoice->invoice_due_date = data_get($data, 'invoice_due_date');

        if ($invoice->save()) {
            $invoice->invoiceItems()->createMany($invoiceItemsList);
        }
        return $invoice;
    }
}
