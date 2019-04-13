<?php

namespace App\Shapes;

/**
 *
 */
class ShapeFactory
{

    public function create(array $shape_data): ShapeAbstract
    {
        $class = 'App\\Shapes\\'.ucfirst($shape_data['type']);

        $type = $this->getClassShortName($class);

        if (! class_exists($class)) {
            throw new \Exception("The shape of type $type does not exist", 500);
        }

        return new $class($shape_data);
    }

    protected function getClassShortName($class) {
        $namespace = explode('\\', $class);
        return array_pop($namespace);
    }
}