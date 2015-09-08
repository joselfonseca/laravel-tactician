<?php

namespace Joselfonseca\LaravelTactician\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    public function test_assert_true()
    {
        $this->assertTrue(true);
    }

}