<?php

namespace App\Http\Controllers;

use App\GraphicEditor;
use App\Shapes\ShapeFactory;
use App\Drivers\DriverFactory;
use App\Format\Binary;
use App\Format\Points;
use Illuminate\Http\Request;

class EditorController extends Controller
{

    /**
     * draw the given shaps and display them in one of the diffrent format.
     *
     * @return Illuminate\Http\Response
     */
    public function draw(Request $request)
    {
        $data = json_decode($request->input('data'), true);

        $shapes = $data['shapes'];

        $editor = new GraphicEditor(new ShapeFactory(), new DriverFactory);

        $editor->load($shapes);

        return $editor->draw(new Binary(500, 500));
        // return $editor->draw(new Points(500, 500));

    }

    // for tests
    public function getData()
    {
        return [
            "shapes" => [
                [
                    "type" => "circle",
                    "perimeter" => 500,
                    "border" => [
                        "color" => "#ff0000",
                        "width" => 6
                    ]
                ],
                [
                    "type" => "square",
                    "sideLength" => 100,
                    "border" => [
                        "color" => [133,55,22],
                        "width" => 10
                    ]
                ],
                [
                    "type" => "square",
                    "sideLength" => 200,
                    "border" => [
                        "color" => "#776cff",
                        "width" => 5
                    ]
                ],
                [
                    "type" => "circle",
                    "perimeter" => 800,
                    "border" => [
                        "color" => "green",
                        "width" => 4
                    ]
                ]
            ]
        ];
    }

}
