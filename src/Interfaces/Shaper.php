<?php

namespace Aviator\Shaper\Interfaces;

use Aviator\Makeable\Interfaces\Makeable;

interface Shaper extends Makeable
{
    /**
     * The callback applied to each iteration.
     * @param mixed $item
     * @return mixed
     */
    public function shaper ($item);

    /**
     * Get the shaped iterable.
     * @return mixed
     */
    public function shape ();

    /**
     * Get the underlying iterable.
     * @return mixed
     */
    public function get ();

    /**
     * Set the iterable to mutate.
     * @param mixed $iterable
     * @return static
     */
    public function set ($iterable);
}
