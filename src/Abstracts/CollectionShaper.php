<?php

namespace Aviator\Shaper\Abstracts;

use Aviator\Makeable\Traits\MakeableTrait;
use Aviator\Shaper\Interfaces\Shaper;
use Illuminate\Support\Collection;

abstract class CollectionShaper implements Shaper
{
    use MakeableTrait;
    
    /** @var \Illuminate\Support\Collection */
    protected $collection;

    /**
     * Constructor.
     * @param \Illuminate\Support\Collection $collection
     */
    public function __construct (Collection $collection = null)
    {
        $this->collection = $collection;
    }

    /**
     * @param mixed $item
     * @return mixed
     */
    abstract public function shaper ($item);

    /**
     * @return \Illuminate\Support\Collection
     */
    public function shape ()
    {
        return $this->collection->map([$this, 'shaper']);
    }

    /**
     * Get the underlying collection
     * @return \Illuminate\Support\Collection
     */
    public function get ()
    {
        return $this->collection;
    }

    /**
     * Set the collection.
     * @param \Illuminate\Support\Collection $collection
     * @return static
     */
    public function set ($collection)
    {
        $this->setCollection($collection);

        return $this;
    }

    /**
     * Set the collection instance.
     * @param \Illuminate\Support\Collection $collection
     */
    protected function setCollection (Collection $collection)
    {
        $this->collection = $collection;
    }
}

