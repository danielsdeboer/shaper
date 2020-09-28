<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Fixtures\Make;

abstract class UnitTest extends TestCase
{
    /** @var \Tests\Fixtures\Make */
    public $make;

    protected function setUp (): void
    {
        parent::setUp();

        $this->make = new Make;
    }

    public function arrayMatches ($item)
    {
        $this->assertIsArray($item);
        $this->assertArrayHasKey('mutated_name', $item);
        $this->assertArrayNotHasKey('reject', $item);
        $this->assertArrayNotHasKey('some_key', $item);
    }

}
