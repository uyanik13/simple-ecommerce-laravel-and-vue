<?php

namespace Evention\Contracts;

interface CoreContract
{
    /**
     * Get the version number of the cms.
     *
     * @return string
     */
    public function version();
}