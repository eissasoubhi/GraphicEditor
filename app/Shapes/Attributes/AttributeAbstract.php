<?php

namespace App\Shapes\Attributes;

/**
 *
 */
abstract class AttributeAbstract
{
    /**
     * @var string
     */
    protected $value;

    /**
     * the original passed value
     * @var string
     */
    protected $original;

    /**
     * @param string $value
     */
    final public function __construct(string $value)
    {
        $this->setValue($value);

        $this->original = $value;
    }

    /**
     * @param string $value
     */
    abstract public function setValue(string $value);

    /**
     * @return string
     */
    abstract public function getValue();
}