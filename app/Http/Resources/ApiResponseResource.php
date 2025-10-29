<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource extends JsonResource
{
    protected $message;
    protected $status;
    protected $error;

    public function __construct($rescource, $message, $status = 200, $error = false){
        parent::__construct($rescource);
        $this->message = $message;
        $this->status = $status;
        $this->error = $error;
    }

    public function toArray($request): array
    {
        return [
            "error" => $this->error,
            "status"=> $this->status,
            "message"=> $this->message,
            "data" => $this->resource,
        ];
    }
}
