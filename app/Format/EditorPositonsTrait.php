<?php

namespace App\Format;

trait EditorPositonsTrait {

    protected $current_x_posotion = 0;

    protected $current_y_posotion = 0;

    public function shiftCurrentXposition($x)
    {
        $this->current_x_posotion += $x;
    }

    public function getCurrentXposition()
    {
        return $this->current_x_posotion;
    }

    public function shiftCurrentYposition($y)
    {
        $this->current_y_posotion += $y;
    }

    public function getCurrentYposition()
    {
        return $this->current_y_posotion;
    }

    public function resetCurrentXposition($x)
    {
        $this->current_x_posotion = $x;
    }

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