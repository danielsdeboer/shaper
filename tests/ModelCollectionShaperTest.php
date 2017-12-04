<?php

namespace Tests;

use Aviator\Shaper\Abstracts\ModelCollectionShaper;
use Illuminate\Database\Eloquent\Collection;
use Tests\Fixtures\RelationCollectionShaper;
use Tests\Fixtures\RelationModelShaper;

class ModelCollectionShaperTest extends UnitTest
{
    /** @test */
    public function it_shapes_a_model ()
    {
        $collection = new Collection([$this->make->model()]);
        $shaper = new ModelCollectionShaper($collection, $this->make->modelShaper());

        $result = $shaper->shape();

        $result->each(function($item) {
            $this->assertSame(['mutated_name' => 'test'], $item);
        });
    }

    /** @test */
    public function it_shapes_a_has_many_relationship ()
    {
        $collection = new Collection([$this->make->model()]);
        $shaper = new ModelCollectionShaper(
            $collection,
            $this->make->modelShaper(),
            [
                'hasManyRelation' => new RelationCollectionShaper,
            ]
        );

        $result = $shaper->shape();

        $result->each(function ($item) {
            $expected = [
                'mutated_name' => 'test',
                'hasManyRelation' => [
                    ['mutated_property' => 'some_value']
                ]
            ];

            $this->assertSame($expected, $item);
        });
    }
    
    /** @test */
    public function it_shapes_a_has_one_relationship ()
    {
        $collection = new Collection([$this->make->model()]);
        $shaper = new ModelCollectionShaper(
            $collection,
            $this->make->modelShaper(),
            [
                'hasOneRelation' => new RelationModelShaper
            ]
        );

        $result = $shaper->shape();

        $result->each(function ($item) {
            $expected = [
                'mutated_name' => 'test',
                'hasOneRelation' => [
                    'mutated_property' => 'some other value!'
                ]
            ];

            $this->assertSame($expected, $item);
        });
    }

    /** @test */
    public function it_can_be_constrained_to_the_base_model_only ()
    {
        $collection = new Collection([$this->make->model()]);
        $shaper = new ModelCollectionShaper(
            $collection,
            $this->make->modelShaper(),
            [
                'hasOneRelation' => new RelationModelShaper,
                'hasManyRelation' => new RelationCollectionShaper
            ]
        );

        /*
         * Calling 'only()' this time
         */
        $result = $shaper->only()->shape();

        $result->each(function ($item) {
            $expected = [
                'mutated_name' => 'test',
            ];

            $this->assertSame($expected, $item);
        });
    }

    /** @test */
    public function it_can_be_constrained_to_one_of_many_relations ()
    {
        $collection = new Collection([$this->make->model()]);
        $shaper = new ModelCollectionShaper(
            $collection,
            $this->make->modelShaper(),
            [
                'hasOneRelation' => new RelationModelShaper,
                'hasManyRelation' => new RelationCollectionShaper
            ]
        );

        /*
         * Calling 'only()' with a relation this time
         */
        $result = $shaper->only(['hasOneRelation'])->shape();

        $result->each(function ($item) {
            $expected = [
                'mutated_name' => 'test',
                'hasOneRelation' => [
                    'mutated_property' => 'some other value!'
                ]
            ];

            $this->assertSame($expected, $item);
        });
    }
}
