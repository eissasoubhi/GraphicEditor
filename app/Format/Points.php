<?php

namespace App\Format;

class Points extends FormatAbstract
{
    use ImageResourceTrait, EditorPositonsTrait;

    public function getResponse()
    {
        $result = [];
        for ($y=0; $y < $this->getHeight(); $y++) {
            for ($x=0; $x < $this->getWidth(); $x++) {
                $rgb = imagecolorat($this->getResource(), $x, $y);

                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                data_set($result, $x.'.'.$y, [$r, $g, $b]);
            }
        }

        return response()->json($result);
    }

}