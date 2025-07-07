<?php

namespace App\Http\Controllers\V1;

use App\Domains\FFL\Models\ffl_acquisition_disposition_book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Interface\FflServiceInterface;
use App\Domains\FFl\Requests\{LogActionRequest,Form_4437_Request,getMultipleSaleRequest};
use App\http\Resources\{ApiResponseResource,ffl_form_Resources,fflResources,multipleSalesResource};

class fflController extends Controller
{
    protected FflServiceInterface $fflService;

    public function __construct(FflServiceInterface $fflService)
    {
        $this->fflService = $fflService;
    }
   public function logbook(LogActionRequest $request){
     $entry_type = $request->query('type'); 
     $validated = $request->validated();
     $logbookData = $this->fflService->logbook($validated, $entry_type);
     return new ApiResponseResource(
       fflResources::collection($logbookData) , 
        'Logbook has been fetched successfully',
        200
     );
   }
   public function forms(Form_4437_Request $request){
    $validated = $request->validated();
    $formData = $this->fflService->forms($validated);
    return new ApiResponseResource(
     ffl_form_Resources::collection($formData) , 
       'Forms has been fetched successfully',
       200
    );
   }
   public function multipleSales(getMultipleSaleRequest $request){
    $validated= $request->validated();
    $multipleslaeData = $this->fflService->multiplesale($validated);
    return new ApiResponseResource(
    multipleSalesResource::collection( $multipleslaeData) , 
       'Multiple Sales has been fetched successfully',
       200
    );
   }

   public function updateMultipleSales(){

   }

   public function getStatus(){

   }

   public function getHistory(){
   }
}