<?php

namespace Aviator\Shaper\Abstracts;

use Aviator\Makeable\Traits\MakeableTrait;
use Aviator\Shaper\Interfaces\Shaper;
use Illuminate\Database\Eloquent\Collection;

class ModelCollectionShaper implements Shaper
{
    use MakeableTrait;
    
    /** @var \Illuminate\Database\Eloquent\Collection */
    protected $collection;

    /** @var string */
    protected $modelShaperClass;

    /** @var \Aviator\Shaper\Abstracts\ModelShaper */
    protected $modelShaper;

    /** @var string[] */
    protected $relationShaperClasses = [];

    /** @var \Aviator\Shaper\Interfaces\Shaper[] */
    protected $relationShapers = [];

    /** @var bool */
    protected $baseModelOnly = false;

    /** @var array */
    protected $specificRelations = [];

    /**
     * Constructor.
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @param \Aviator\Shaper\Abstracts\ModelShaper|null $modelShaper
     * @param array|null $relationShapers
     */
    public function __construct (
        Collection $collection = null,
        ModelShaper $modelShaper = null,
        array $relationShapers = null
    )
    {
        $this->collection = $collection;
        $this->modelShaper = $modelShaper ?: new $this->modelShaperClass;
        $this->setRelationShapers($relationShapers);
    }

    /**
     * Specify (without parameter) to only shape the base model and discard relations.
     * Or (with parameter) to shape the base model plus the given relations,
     * discarding other relations.
     * @param array|string|null $relations
     * @return $this
     */
    public function only ($relations = null)
    {
        $this->baseModelOnly = !$relations;

        if ($relations) {
            $this->specificRelations = (array) $relations;
        }

        return $this;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    public function shaper ($model)
    {
        /** @var \Aviator\Shaper\Abstracts\ModelShaper[] */
        $relations = $this->filteredRelations();
        $shapedRelations = [];

        /*
         * The relations in the filtered relations array should
         * be model collection shapers (for a has many relation)
         * or a model shaper (for a has one relation).
         */
        foreach ($relations as $property => $shaper) {
            if ($shaper instanceof ModelCollectionShaper) {
                $shapedRelations[$property] = $shaper
                    ->set($model->{$property})
                    ->shape()
                    ->toArray();
            }

            if ($shaper instanceof ModelShaper) {
                $shapedRelations[$property] = $shaper
                    ->set($model->{$property})
                    ->shape();
            }
        }

        $shapedBaseModel = $this->modelShaper->set($model)->shape();

        return $shapedBaseModel + $shapedRelations;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function shape ()
    {
        return $this->collection->map([$this, 'shaper']);
    }

    /**
     * Get the underlying collection
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get ()
    {
        return $this->collection;
    }

    /**
     * Set the collection.
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @return static
     */
    public function set ($collection)
    {
        $this->setCollection($collection);

        return $this;
    }

    /**
     * Set the collection instance.
     * @param \Illuminate\Database\Eloquent\Collection $collection
     */
    protected function setCollection (Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Set the array of relation model shapers if provided, otherwise
     * instantiate the default shapers.
     * @param array|string|null $relationModelShapers
     */
    protected function setRelationShapers ($relationModelShapers = null)
    {
        if ($relationModelShapers) {
            $this->relationShapers = $relationModelShapers;
        } else {
            foreach ($this->relationShaperClasses as $method => $class) {
                $this->relationShapers[$method] = new $class;
            }
        }
    }

    /**
     * Get a list of keyed relations to use.
     * @return array|\Aviator\Shaper\Abstracts\ModelShaper[]
     */
    protected function filteredRelations ()
    {
        if ($this->baseModelOnly) {
            return [];
        }

        if (!$this->baseModelOnly && count($this->specificRelations) === 0) {
            return $this->relationShapers;
        }

        return array_filter(
            $this->relationShapers,
            function ($item, $key) {
                return in_array($key, $this->specificRelations);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}

