<?php

namespace App\Format;

/**
 * This Points format manage the editor (the canvas) whereon
 * the shapes are drwan before they are converted to an array of points
 *
 * @see App\Format\ImageResourceTrait;
 * @see App\Format\EditorPositonsTrait;
 */
class Points extends FormatAbstract
{
    use ImageResourceTrait, EditorPositonsTrait;

    /**
     * converts the binary image to an array of pixels.
     *
     * @return Illuminate\Http\Response
     */
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