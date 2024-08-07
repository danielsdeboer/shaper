<?php

namespace Aviator\Shaper\Item;

use Closure;

abstract class ItemShaper
{
    /** @var mixed */
    protected $item;

    /** @var \Closure */
    protected $shaperCb;

    /**
     * @return mixed
     */
    abstract public function shaper($item);

    /**
     * @return array
     */
    public function shape()
    {
        return $this->shaper($this->item);
    }

    /**
     * Get the underlying array
     *
     * @return array
     */
    public function get()
    {
        return $this->item;
    }

    /**
     * Set the array.
     *
     * @param array $item
     * @return static
     */
    public function set($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Set the callback.
     *
     * @return $this
     */
    public function setCallback(Closure $callback)
    {
        $this->shaperCb = $callback;

        return $this;
    }
}
