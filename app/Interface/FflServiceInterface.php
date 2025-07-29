<?php

namespace App\Interface;

interface FflServiceInterface
{
  
    public function logbook($request , $entry_type);
    public function forms($request);
    public function multiplesale ($request);
    public function UpdateMultiplesale ($request);
    public function getFirearmStatus($firearm_id);
    public function AddFirearm($request);
    public function Acquisition($request);

}
