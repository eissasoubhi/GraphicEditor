<?php

namespace App\Format;

use App\Shapes\ShapeAbstract;

/**
 * This Binary format manage the editor (the canvas) whereon the shapes are drwan
 *
 * @see App\Format\ImageResourceTrait;
 * @see App\Format\EditorPositonsTrait;
 */
class Binary extends FormatAbstract
{
    use ImageResourceTrait, EditorPositonsTrait;

    /**
     * send a binary image
     */
    public function getResponse()
    {
        ob_start();
        call_user_func('imagepng', $this->getResource());
        $content = ob_get_contents();
        ob_end_clean();

        return response($content, 200)
                ->header('Content-Type', 'image/png');
    }

}