<?php

namespace Tests\Fixtures;

use Aviator\Shaper\Abstracts\ModelCollectionShaper;

class RelationCollectionShaper extends ModelCollectionShaper
{
    protected $modelShaperClass = RelationModelShaper::class;
}
