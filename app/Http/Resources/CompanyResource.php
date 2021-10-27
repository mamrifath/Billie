<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
                'company_id' => $this->id,
                'company_email' => $this->company_email,
                'company_mobile_no' => $this->company_mobile_no,
            ]
        ];
    }
}
