<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;

class ModelShaperTest extends UnitTest
{
    /** @test */
    public function it_shapes_a_single_model ()
    {
        $shaper = $this->make->modelShaper(
            $this->make->model()
        );

        $shaped = $shaper->shape();

        $this->assertInternalType('array', $shaped);
        $this->arrayMatches($shaped);
    }

    /** @test */
    public function it_may_set_the_model_after_instantiation ()
    {
        $shaper = $this->make->modelShaper();

        $this->assertNull($shaper->get());

        $shaper->set($this->make->model());

        $this->assertInstanceOf(Model::class, $shaper->get());
    }
}
