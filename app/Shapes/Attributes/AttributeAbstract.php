<?php

namespace App\Shapes\Attributes;

/**
 *
 */
abstract class AttributeAbstract
{
    protected $value;

    protected $original;

    function __construct($value)
    {
        $this->setValue($value);

        $this->original = $value;
    }

    abstract public function setValue($value);

    abstract public function getValue();
}