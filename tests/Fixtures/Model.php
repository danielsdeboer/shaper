<?php

namespace Tests\Fixtures;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];

    public $hasManyRelation;
    public $hasOneRelation;

    public function __construct (array $attributes = [])
    {
        parent::__construct($attributes);

        $this->hasManyRelation = new Collection([
            new Relation(['property' => 'some_value'])
        ]);

        $this->hasOneRelation = new Relation([
            'property' => 'some other value!',
            'this_should' => 'be discarded'
        ]);
    }
}
