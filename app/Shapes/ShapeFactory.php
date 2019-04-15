<?php

namespace App\Shapes;

use App\Shapes\Attributes\AttributeFactory;
/**
 *
 */
class ShapeFactory
{

    /**
     * @param string $type
     * @param array $attributes
     * @return App\Shapes\ShapeAbstract
     */
    public function create(string $type, array $attributes): ShapeAbstract
    {
        $class = 'App\\Shapes\\'.ucfirst(strtolower($type));

        $type = $this->getClassShortName($class);

        if (! class_exists($class)) {
            throw new \RuntimeException("The shape of type $type does not exist");
        }

        return new $class($attributes, new AttributeFactory);
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