<?php

namespace Tests\Fixtures;

use Aviator\Shaper\Abstracts\ArrayShaper;
use Aviator\Shaper\Abstracts\CollectionShaper;
use Aviator\Shaper\Abstracts\ModelShaper;
use Aviator\Shaper\Item\ArrayItemShaper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Tests\Fixtures\Model as ModelFixture;

class Make
{
    /** @var array */
    protected $collectionItems = [
        ['name' => 'some name', 'reject' => 'this item'],
        ['name' => 'other name', 'some_key' => 'to be rejected'],
        ['name' => 'third item', 'reject' => 'this item'],
    ];

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection () : Collection
    {
        return new Collection($this->collectionItems);
    }

    /**
     * @return array
     */
    public function array () : array
    {
        return $this->collectionItems;
    }

    /**
     * @return array
     */
    public function arrayItem () : array
    {
        return $this->collectionItems[0];
    }

    /**
     * @return \Closure
     */
    public function callback () : \Closure
    {
        return function ($item) {
            return [
                'mutated_name' => $item['name']
            ];
        };
    }

    /**
     * @param array|null $item
     * @return \Aviator\Shaper\Item\ArrayItemShaper
     */
    public function arrayItemShaper (array $item = null)
    {
        return new class($item) extends ArrayItemShaper {
            public function shaper ($item)
            {
                return [
                    'mutated_name' => $item['name']
                ];
            }
        };
    }

    /**
     * @param \Illuminate\Support\Collection|null $collection
     * @return \Aviator\Shaper\Abstracts\CollectionShaper
     */
    public function collectionShaper (Collection $collection = null)
    {
        return new class($collection) extends CollectionShaper {
            public function shaper ($item)
            {
                return [
                    'mutated_name' => $item['name']
                ];
            }
        };
    }

    /**
     * @param array|null $array
     * @return \Aviator\Shaper\Abstracts\ArrayShaper
     */
    public function arrayShaper (array $array = null)
    {
        return new class($array) extends ArrayShaper {
            public function shaper ($item)
            {
                return [
                    'mutated_name' => $item['name']
                ];
            }
        };
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Aviator\Shaper\Abstracts\ModelShaper
     */
    public function modelShaper (Model $model = null)
    {
        return new class($model) extends ModelShaper {
            public function shaper ($item)
            {
                return [
                    'mutated_name' => $item->name
                ];
            }
        };
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model ()
    {
        return new ModelFixture(['name' => 'test']);
    }
}
