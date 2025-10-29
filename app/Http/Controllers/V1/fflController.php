<?php

namespace App\Http\Controllers\V1;

use App\Domains\FFL\Models\ffl_acquisition_disposition_book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Interface\FflServiceInterface;
use App\Domains\FFl\Requests\{LogActionRequest,Form_4437_Request,getMultipleSaleRequest, get_Firearm_Status_Request,AddfirearmRequest,AcquisitionRequest};
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

   public function updateMultipleSales($request){
      $validated = $request->validated();
      $multiplesaleData = $this->fflService->UpdateMultiplesale($validated);
      return new ApiResponseResource(
         $multiplesaleData, 
        'Multiple Sales has been updated successfully',
        200
      );
   }

   public function getFirearmStatus(get_Firearm_Status_Request $request){
      $validated= $request->validated();
      $response = $this->fflService->getFirearmStatus($validated);
      return new ApiResponseResource(
         $response ,
         'Firearm Status has been fetched successfully',
         200
         );

   }

   public function getHistory(){
   }

   public function AddFirearm(AddfirearmRequest $request){
      $validated= $request->validated();
      $firearm = $this->fflService->AddFirearm($validated);
      return new ApiResponseResource(
         $firearm,
         'Firearm has been added successfully',
         200
         );

   }

   public function Acquisition( $request){
      $validated= $request->validated();
      $response = $this->fflService-> Acquisition($validated);
      return new ApiResponseResource(
         $response,
         'Acquisition has been added successfully',
         200
         );
   }
}