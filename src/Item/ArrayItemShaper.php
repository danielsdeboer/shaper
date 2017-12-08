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
     * @param array|null $item
     * @param \Closure|null $shaper
     */
    public function __construct (array $item = null, Closure $shaper = null)
    {
        $this->set($item);

        $this->shaperCb = $shaper;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function shaper ($item)
    {
        $cb = $this->shaperCb;

        return $cb($item);
    }
}

