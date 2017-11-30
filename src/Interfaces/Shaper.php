<?php

namespace Aviator\Shaper\Interfaces;

interface Shaper
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
