<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'tenant' => $this->tenant->name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address ? collect($this->address)->map(function ($customerAddress) {
                return [
                    'address1' => $customerAddress->address_line1 ?? '',
                    'address2' => $customerAddress->address_line2 ?? '',
                    'city' => $customerAddress->city ?? '',
                    'state' => $customerAddress->state ?? '',
                    'zipcode' => $customerAddress->zip_code ?? '',
                    'country' => $customerAddress->country ?? '',
                    'address_type' => $customerAddress->address_type ?? '',
                ];
            }) : null,

        ];
    }
}
