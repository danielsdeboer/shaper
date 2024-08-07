<?php

namespace Aviator\Shaper\Item;

use Aviator\Makeable\Traits\MakeableTrait;
use Aviator\Shaper\Interfaces\Shaper;
use Closure;

class ArrayItemShaper extends ItemShaper implements Shaper
{
    use MakeableTrait;

    /**
     * Constructor.
     */
    public function __construct(array|null $item = null, Closure|null $shaper = null)
    {
        $this->set($item);

        $this->shaperCb = $shaper;
    }

    /**
     * @return mixed
     */
    public function shaper($item)
    {
        $cb = $this->shaperCb;

        return $cb($item);
    }
}
