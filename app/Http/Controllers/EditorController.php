<?php

namespace App\Http\Controllers;

use App\GraphicEditor;
use App\Shapes\ShapeFactory;
use App\Drivers\DriverFactory;

class EditorController extends Controller
{

    public function draw()
    {
        $data = $this->getData();

        $shapes = $data['shapes'];

        $editor = new GraphicEditor(new ShapeFactory(), new DriverFactory);

        $editor->load($shapes);

        // dd($editor);

        $binaryResult = $editor->draw('binary');

        return response($this->fetchOutput($binaryResult, 'imagepng'), 200)
                  ->header('Content-Type', 'image/png');

    }

    protected function fetchOutput($img, $function)
    {
        ob_start();
        call_user_func($function, $img);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function getData()
    {

        return [
            "shapes" => [
                [
                    "type" => "circle",
                    "perimeter" => 1000,
                    "border" => [
                        "color" => "#ff0000",
                        "width" => 13
                    ]
                ],
                [
                    "type" => "square",
                    "sideLength" => 200,
                    "border" => [
                        "color" => "#776cff",
                        "width" => 15
                    ]
                ]
            ]
        ];
    }

}
