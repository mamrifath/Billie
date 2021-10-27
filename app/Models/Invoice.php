<?php

namespace App\Models;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'invoice_from', 'invoice_to', 'invoice_date', 'invoice_type', 'invoice_total', 'invoice_due_date'];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }
}
