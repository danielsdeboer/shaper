<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Fixtures\Make;

abstract class UnitTest extends TestCase
{
    /** @var \Tests\Fixtures\Make */
    public $make;

    protected function setUp ()
    {
        parent::setUp();

        $this->make = new Make;
    }

    public function arrayMatches ($item)
    {
        $this->assertInternalType('array', $item);
        $this->assertArrayHasKey('mutated_name', $item);
        $this->assertArrayNotHasKey('reject', $item);
        $this->assertArrayNotHasKey('some_key', $item);
    }

}
