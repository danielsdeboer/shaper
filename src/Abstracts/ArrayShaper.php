<?php

namespace Aviator\Shaper\Abstracts;

use Aviator\Shaper\Interfaces\Shaper;
use Illuminate\Support\Collection;

abstract class ArrayShaper implements Shaper
{
    /** @var array */
    protected $array;

    /**
     * Constructor.
     * @param array|null $array
     */
    public function __construct (array $array = null)
    {
        $this->array = $array;
    }

    /**
     * @param mixed $item
     * @return mixed
     */
    abstract public function shaper ($item);

    /**
     * @return array
     */
    public function shape ()
    {
        return array_map([$this, 'shaper'], $this->array);
    }

    /**
     * Get the underlying array
     * @return array
     */
    public function get ()
    {
        return $this->array;
    }

    /**
     * Set the array.
     * @param array $array
     * @return static
     */
    public function set ($array)
    {
        $this->setArray($array);

        return $this;
    }

    /**
     * Set the collection instance.
     * @param array $array
     */
    protected function setArray (array $array)
    {
        $this->array = $array;
    }
}

