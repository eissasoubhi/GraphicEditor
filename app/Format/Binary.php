<?php

namespace App\Format;

use App\Shapes\ShapeAbstract;

class Binary extends FormatAbstract
{
    use ImageResourceTrait, EditorPositonsTrait;

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