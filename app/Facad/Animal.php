<?php


namespace App\Facad;


use Illuminate\Support\Facades\Facade;

class Animal extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'animal';
    }
}
