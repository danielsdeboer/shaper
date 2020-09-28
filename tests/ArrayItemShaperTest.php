<?php

namespace Tests;

use Aviator\Shaper\Item\ArrayItemShaper;
use Illuminate\Database\Eloquent\Model;

class ArrayItemShaperTest extends UnitTest
{
    /** @test */
    public function it_can_be_instantiated_with_an_anonymous_function ()
    {
        $shaper = new ArrayItemShaper(
            $this->make->arrayItem(),
            $this->make->callback()
        );

        $shaped = $shaper->shape();

        $this->assertIsArray($shaped);
        $this->arrayMatches($shaped);
    }

    /** @test */
    public function the_item_and_callback_can_be_added_after_instantiation ()
    {
        $shaper = new ArrayItemShaper;

        $shaper->set($this->make->arrayItem());
        $shaper->setCallback($this->make->callback());

        $shaped = $shaper->shape();

        $this->assertIsArray($shaped);
        $this->arrayMatches($shaped);
    }

    /** @test */
    public function extending_classes_can_ignore_the_callback_and_override_the_method ()
    {
        $shaper = $this->make->arrayItemShaper(
            $this->make->arrayItem()
        );

        $shaped = $shaper->shape();

        $this->assertIsArray($shaped);
        $this->arrayMatches($shaped);
    }

    /** @test */
    public function extensions_may_also_set_the_item_after_instantiation ()
    {
        $shaper = $this->make->arrayItemShaper();

        $this->assertNull($shaper->get());

        $shaper->set($this->make->model());

        $this->assertInstanceOf(Model::class, $shaper->get());
    }
}
