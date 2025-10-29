<?php

namespace App\Domains\FFL\Services;

use App\Domains\FFL\Actions\{FormsAction, LogbookAction, MultipleSaleAction,UpdateMultipleSaleAction,GetFirearmStatusAction,AddFirearmAction};
use App\Interface\FflServiceInterface;

class fflServices implements FflServiceInterface
{
    protected LogbookAction $logbookAction;
    protected FormsAction $formsAction;
    protected MultipleSaleAction $multipleSaleAction;
    protected UpdateMultipleSaleAction $updateMultipleSaleAction;
    protected GetFirearmStatusAction $getFirearmStatusAction;
    protected AddFirearmAction $addFirearmAction;
    public function __construct(LogbookAction $logbookAction, FormsAction $formsAction, MultipleSaleAction $multipleSaleAction, UpdateMultipleSaleAction $updateMultipleSaleAction, GetFirearmStatusAction $getFirearmStatusAction, AddFirearmAction $addFirearmAction)
    {
        $this->logbookAction = $logbookAction;
        $this->formsAction = $formsAction;
        $this->multipleSaleAction = $multipleSaleAction;
        $this->updateMultipleSaleAction = $updateMultipleSaleAction;
        $this->getFirearmStatusAction = $getFirearmStatusAction;
        $this->addFirearmAction = $addFirearmAction;
    }

    public function logbook($request, $entry_type)
    {
        return $this->logbookAction->handle($request, $entry_type);
    }

    public function forms($request)
    {
        return $this->formsAction->handle($request);
    }

    public function multiplesale($request)
    {
        return $this->multipleSaleAction->handle($request);
    }

    public function UpdateMultiplesale($request)
    {
        return $this->updateMultipleSaleAction->handle($request);
    }

    public function getFirearmStatus($firearm_id){
        return $this->getFirearmStatusAction->handle($firearm_id);
    }

    public function AddFirearm($request){
        return $this->addFirearmAction->handle($request);
    }

    public function Acquisition($request){
        return $this->addFirearmAction->handle($request);
    }
}
