<?php

namespace App\Drivers;

/**
 * This trait functions are shared between both the Binary and the Points drivers of all the shapes.
 */
use App\Format\FormatAbstract;
use App\Drivers\BinaryRendererTrait;

trait BinaryRendererTrait {

    /**
     * manage the shapes postions on the canvas after and befor the drawing of each shape.
     * after drawing a shape, the position andicator will shift forward to the next shape position,
     * as result all the shapes will be drawn one next to another.
     *
     * @return App\Format\FormatAbstract
     */
    public function render(): FormatAbstract
    {
        $editor = $this->format;

        $this->presetEditorPosition();

        $this->draw();

        $this->updateEditotPosition();

        $editor->addRendedShape($this->shape);

        return $this->format;
    }

    /**
     * set the x and the y positions wharein the current shape will be drawn
     */
    public function presetEditorPosition()
    {
        $editor = $this->format;

        $editor->shiftCurrentXposition($this->shape->getBorderWidth() / 2);

        // if there is no space left on the right of the convas to shift to,
        // we update the y axis to shift down to the next line
        if ($editor->getWidth() - $editor->getCurrentXposition() < $this->shape->getWidth(true)
            && $editor->getHeight() - $editor->getCurrentYposition() >= $this->shape->getHeight(true)) {

            $editor->shiftCurrentYposition($editor->biggestYpostion());
            $editor->resetCurrentXposition($this->shape->getBorderWidth() / 2);

        }
    }

    /**
     * set the x and the y positions wharein the next shape will be drawn
     */
    public function updateEditotPosition()
    {
        $this->format->shiftCurrentXposition($this->shape->getWidth() + ($this->shape->getBorderWidth() / 2));
    }
}