<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResponseResource extends JsonResource
{
    public function toArray($request){
        return [
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'role'=>$this->role->name,
            'location_name'=>$this->location->name,
            'tenant_name'=>$this->tenant->name,
        ];

    }
}