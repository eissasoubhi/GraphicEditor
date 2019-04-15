<?php

namespace App\Shapes\Attributes;

/**
 *
 */
class AttributeFactory
{

    /**
     * @param string $name
     * @param string $value
     * @return App\Shapes\Attributes\AttributeAbstract
     */
    public function create(string $name, string $value): AttributeAbstract
    {
        $class = 'App\\Shapes\\Attributes\\'.ucfirst(strtolower($name));

        $name = $this->getClassShortName($class);

        if (! class_exists($class)) {
            throw new \RuntimeException("The shape $name does not exist");
        }

        return new $class($value);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function attributeExists(string $name)
    {
        return class_exists('App\\Shapes\\Attributes\\'.ucfirst(strtolower($name)));
    }

    /**
     * @param string $class
     * @return string
     */
    protected function getClassShortName(string $class) {
        $namespace = explode('\\', $class);
        return array_pop($namespace);
    }
}