<?php

namespace App\Interface;

interface FflServiceInterface
{
  
    public function logbook($request , $entry_type);
    public function forms($request);
    public function multiplesale ($request);

}
