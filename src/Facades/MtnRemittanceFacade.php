<?php

namespace RizwanNasir\MtnMomo\Facades;

use Illuminate\Support\Facades\Facade;


class MtnRemittanceFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'mtn-momo-remittance'; 
    }
}
