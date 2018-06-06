<?php

namespace Tests;

abstract class AdminTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware([\Illuminate\Auth\Middleware\Authenticate::class]);
    }
}
