<?php

namespace App\Drivers;

use App\Format\FormatAbstract;
use App\Drivers\BinaryRendererTrait;

trait BinaryRendererTrait {

    public function render(): FormatAbstract
    {
        $editor = $this->format;

        $this->presetEditorPosition();

        $this->draw();

        $this->updateEditotPosition();

        $editor->addRendedShape($this->shape);

        return $this->format;
    }

    public function presetEditorPosition()
    {
        $editor = $this->format;

        $editor->shiftCurrentXposition($this->shape->getBorderWidth() / 2);

        if ($editor->getWidth() - $editor->getCurrentXposition() < $this->shape->getWidth(true)
            && $editor->getHeight() - $editor->getCurrentYposition() >= $this->shape->getHeight(true)) {

            $editor->shiftCurrentYposition($editor->biggestYpostion());
            $editor->resetCurrentXposition($this->shape->getBorderWidth() / 2);

        }
    }

    public function updateEditotPosition()
    {
        $this->format->shiftCurrentXposition($this->shape->getWidth() + ($this->shape->getBorderWidth() / 2));
    }
}