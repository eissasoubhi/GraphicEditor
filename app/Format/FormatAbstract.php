<?php

namespace App\Format;

abstract class FormatAbstract
{

    protected $resource = null;

    abstract protected function activateResource();

    public function getResource()
    {
        if (is_null($this->resource)) {
            $this->resource = $this->activateResource();
        }

        return $this->resource;
    }
}