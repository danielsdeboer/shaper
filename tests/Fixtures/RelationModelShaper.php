<?php

namespace Tests\Fixtures;

use Aviator\Shaper\Abstracts\ModelShaper;

class RelationModelShaper extends ModelShaper
{
    /**
     * @param mixed $item
     * @return mixed
     */
    public function shaper ($item)
    {
        return [
            'mutated_property' => $item->property
        ];
    }
}
