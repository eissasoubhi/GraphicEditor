<?php

namespace App\Drivers;

use App\Format\FormatAbstract;
use App\Shapes\ShapeAbstract;

abstract class DriverAbstract
{

    protected $shape;

    protected $format;


    public function __construct(ShapeAbstract $shape, FormatAbstract $format)
    {
        $this->shape  = $shape;
        $this->format = $format;
    }

    public function render()
    {
        $editor = $this->format;

        imagesetthickness($editor->getResource(), $this->shape->getBorderWidth());

        $editor->shiftCurrentXposition($this->shape->getBorderWidth() / 2);


        if ($editor->getWidth() - $editor->getCurrentXposition() < $this->shape->getWidth(true)
            && $editor->getHeight() - $editor->getCurrentYposition() >= $this->shape->getHeight(true)) {

            $editor->shiftCurrentYposition($editor->biggestYpostion());
            $editor->resetCurrentXposition($this->shape->getBorderWidth() / 2);

        }

        $this->draw();

        $editor->shiftCurrentXposition($this->shape->getWidth() + ($this->shape->getBorderWidth() / 2));

        $editor->addRendedShape($this->shape);
    }

    abstract public function draw();
}