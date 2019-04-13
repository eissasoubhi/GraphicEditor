<?php

namespace App\Shapes\Attributes;

/**
 *
 */
class AttributeFactory
{

    public function create($name, $value): AttributeAbstract
    {
        $class = 'App\\Shapes\\Attributes\\'.ucfirst(strtolower($name));

        $name = $this->getClassShortName($class);

        if (! class_exists($class)) {
            throw new \RuntimeException("The shape $name does not exist");
        }

        return new $class($value);
    }

    public function attributeExists($name)
    {
        return class_exists('App\\Shapes\\Attributes\\'.ucfirst(strtolower($name)));
    }

    protected function getClassShortName($class) {
        $namespace = explode('\\', $class);
        return array_pop($namespace);
    }
}