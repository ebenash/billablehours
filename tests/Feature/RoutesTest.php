<?php

namespace Tests\Feature;

use Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReadFilePage()
    {
        Session::start();
        $response = $this->call('POST', 'invoices', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(302, $response->getStatusCode());
    }


    public function testInvoiceGeneratePage()
    {
        Session::start();
        $response = $this->call('POST', 'details', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(302, $response->getStatusCode());
    }

}
