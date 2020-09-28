<?php

namespace Aviator\Shaper\Abstracts;

use Aviator\Makeable\Traits\MakeableTrait;
use Aviator\Shaper\Interfaces\Shaper;
use Illuminate\Database\Eloquent\Model;

abstract class ModelShaper implements Shaper
{
    use MakeableTrait;

    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;

    public function __construct (Model $model = null)
    {
        $this->model = $model;
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
        return $this->shaper($this->model);
    }

    /**
     * Get the underlying model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function get ()
    {
        return $this->model;
    }

    /**
     * Set the array.
     * @param \Illuminate\Database\Eloquent\Model $item
     * @return static
     */
    public function set ($item)
    {
        $this->setModel($item);

        return $this;
    }

    /**
     * Set the collection instance.
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    protected function setModel (Model $model)
    {
        $this->model = $model;
    }
}

