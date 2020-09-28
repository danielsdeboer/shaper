<?php

namespace Tests;

class ArrayShaperTest extends UnitTest
{
    /** @test */
    public function it_iterates_over_and_transforms_the_array ()
    {
        $shaper = $this->make->arrayShaper(
            $this->make->array()
        );

        $shaped = $shaper->shape();

        $this->assertIsArray($shaped);
        array_map([$this, 'arrayMatches'], $shaped);
    }

    /** @test */
    public function it_can_set_the_array_after_instantiation ()
    {
        $shaper = $this->make->arrayShaper();

        $this->assertNull($shaper->get());

        $shaper->set($this->make->array());

        $this->assertIsArray($shaper->get());
    }
}
