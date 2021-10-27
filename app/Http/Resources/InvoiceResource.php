<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'code' => '200',
            'message' => 'success',
            'data' => [
                'invoice_id' => $this->id,
                'company_id' => $this->company_id,
                'invoice_from' => $this->invoice_from,
                'invoice_to' => $this->invoice_to,
                'invoice_date' => $this->invoice_date,
                'invoice_due_date' => $this->invoice_due_date,
                'invoice_item' => '',
            ]
        ];
    }
}
