<?php

namespace App\Format;

/**
 * This trait functions are shared between both the Binary and the Points format.
 */
trait EditorPositonsTrait {

    /**
     * The current x the cursor position on the canvas
     * @var int
     */
    protected $current_x_posotion = 0;

    /**
     * The current y the cursor position on the canvas
     * @var int
     */
    protected $current_y_posotion = 0;

    /**
     * @param int $x
     */
    public function shiftCurrentXposition(int $x)
    {
        $this->current_x_posotion += $x;
    }

    public function getCurrentXposition()
    {
        return $this->current_x_posotion;
    }

    /**
     * @param int $y
     */
    public function shiftCurrentYposition(int $y)
    {
        $this->current_y_posotion += $y;
    }

    public function getCurrentYposition()
    {
        return $this->current_y_posotion;
    }

    /**
     * @param int $x
     */
    public function resetCurrentXposition(int $x)
    {
        $this->current_x_posotion = $x;
    }

    /**
     * return the length of the longest shape on the canvas to use it as
     * the y position of to shift down to the next line in the canvas
     * @return int
     */
    public function biggestYpostion()
    {
        if (! count($this->rended_shapes)) {
            return 0;
        }

        $biggest_y = array_reduce($this->rended_shapes, function ($max, $current)
        {
            return $current->getHeight(true) > $max ? $current->getHeight(true) : $max;
        });

        return $biggest_y;
    }
}