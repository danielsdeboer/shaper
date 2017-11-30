<?php

namespace Tests;

use Illuminate\Support\Collection;

class CollectionShaperTest extends UnitTest
{
    /** @test */
    public function it_iterates_over_and_transforms_the_collection ()
    {
        $shaper = $this->make->collectionShaper(
            $this->make->collection()
        );

        $shaped = $shaper->shape();

        $this->assertInstanceOf(Collection::class, $shaped);
        $shaped->each([$this, 'arrayMatches']);
    }

    /** @test */
    public function it_can_set_the_collection_after_instantiation ()
    {
        $shaper = $this->make->collectionShaper();

        $this->assertNull($shaper->get());

        $shaper->set($this->make->collection());

        $this->assertInstanceOf(Collection::class, $shaper->get());
    }
}
