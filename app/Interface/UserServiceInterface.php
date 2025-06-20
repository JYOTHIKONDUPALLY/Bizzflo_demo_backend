<?php namespace App\Interface;

interface UserServiceInterface
{
    public function registerBusinessUser( $request);
    public function loginBusinessUser( $request);
    public function logoutBusinessUser( $request);
    public function getAllBusinessUsers($request);
}