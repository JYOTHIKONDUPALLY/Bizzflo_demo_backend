<?php

namespace App\Domains\FFL\Services;

use App\Domains\FFL\Actions\{FormsAction, LogbookAction, MultipleSaleAction};
use App\Interface\FflServiceInterface;

class fflServices implements FflServiceInterface
{
    protected LogbookAction $logbookAction;
    protected FormsAction $formsAction;
    protected MultipleSaleAction $multipleSaleAction;
    public function __construct(LogbookAction $logbookAction, FormsAction $formsAction, MultipleSaleAction $multipleSaleAction)
    {
        $this->logbookAction = $logbookAction;
        $this->formsAction = $formsAction;
        $this->multipleSaleAction = $multipleSaleAction;
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
}
