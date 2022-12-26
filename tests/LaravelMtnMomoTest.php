<?php

namespace RizwanNasir\MtnMomo\Tests;
   
use Orchestra\Testbench\TestCase;
use RizwanNasir\MtnMomo\MtnCollection;
use RizwanNasir\MtnMomo\MtnDisbursement;
use RizwanNasir\MtnMomo\MtnMomoServiceProvider;
use RizwanNasir\MtnMomo\MtnRemittance;

class LaravelMtnMomoTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [MtnMomoServiceProvider::class];
    }
    

    public function test_namespaces_are_valid()
    { 
        $this->assertInstanceOf( MtnMomoServiceProvider::class, new MtnMomoServiceProvider(app()) );

        // $this->assertInstanceOf(Sms::class, new Sms);
    }


    public function test_facades_are_valid()
    {
        
        $this->assertInstanceOf(MtnCollection::class,       app()->make('mtn-momo-collection') );

        $this->assertInstanceOf(MtnRemittance::class,       app()->make('mtn-momo-remittance') );

        $this->assertInstanceOf(MtnDisbursement::class,     app()->make('mtn-momo-disbursement') );
    }
 
}
