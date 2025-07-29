<?php

namespace App\Domains\FFL\Actions;
use App\Domains\FFL\Models\ffl_multiple_sale_forms;
use App\Domains\FFL\Models\ffl_multiple_sale_firearms;

class UpdateMultipleSaleAction
{
    public function handle($request)
    {
        return ffl_multiple_sale_forms::where('id', $request['multiple_sale_form_id'])->update($request->all());
    }
}