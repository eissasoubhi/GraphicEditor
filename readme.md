
# # GraphicEditor

This project is a simple web coding test as the second step for a job application.
This app is developed with [Lumen](https://lumen.laravel.com/). it should draw geometric shapes such as
circle, square, rectangle, ellipse... etc. Each shape might have various attributes like border
color and size, fill color... etc.
**It should support adding more shapes quickly, easily and with minimum code
changes.** 
It provides an implementation for the circle and the square shapes.
The application also should display the result (i.e. the drawn shapes) in any format: array of points, image (binary file)... I call them drivers in the code.

# Installing 

     1. $ clone git@github.com:eissasoubhi/GraphicEditor.git
     2. $ cd GraphicEditor/
     3. $ composer install

# Usage

The first thing we run the server with `php -S localhost:4000 -t public`
The application exposes an endpoint that receives JSON input.
**To see the result, you'll have to send a post request to this link [localhost:4000/draw](localhost:4000/draw) with json input in a post parameter with the name 'data'.**
The best way to do that is by using [Postaman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en), a pefect app for api calls. 

This is a JSON exmple to send with the post request:

{"shapes":[{"type":"circle","perimeter":500,"border":{"color":"#ff0000","width":6}},{"type":"square","sideLength":100,"border":{"color":[133,55,22],"width":10}},{"type":"square","sideLength":200,"border":{"color":"#776cff","width":5}},{"type":"circle","perimeter":800,"border":{"color":"green","width":4}}]}

This is a screenshot of Postman with the link:
![ a screenshot of Postman with the link](/postman-screenshot.png)

# How the JSON is parsed?

The application checks the validation of the shapes types and their attributes. if they are invalid or misspelled it throws an exception.
The color attribute of the shapes can be in three different forms, hex eg: #FF0000, array eg: [255, 0, 0] or the color name eg: red.

# How is it made?

The application is decoupled to different parts: 
**Drivers**: the implementation of the output for both binary and points types. each shape has its own drivers of both types
**Format**: outputs the result depending on the driver type, each driver type has its own corresponding format.
**Shapes**.
**Shapes attributes.**
**GraphicEditor**: orchestrate the above classes to produce the desired result

The core components are the drivers, so here is how they work:
**The Binary driver**: it simply uses the PHP GD library to draw the shapes.

**The Points driver**: this one is the catch, it should normally display the shape as an array of points (pixels), but the only way could find to do that is by making a binary image first then convert that image later to an array of pixels. 
It works well but the problem here is that **the Points driver will be depending on the Binary driver in order to work**, so what I did is **I extracted the code that creates an image from the Binary driver classes into traits and imported those traits in both Binary and Points drivers classes.**


# Scaling
### Add more shapes
As stated in the beginning, this app should support adding more shapes quickly, easily and with minimum code.
Let's say you wanna add the line shape:

 1. The first thing to do is create a folder with name Line in
    **app/Drivers/Line** with three files inside it: **Binary.php**, **Points.php**,
    and **BinaryDrawerTrait.php**.
	- In Binary.php and Points.php, mostly the only thing to change in them is the 					namespace.
    - In BinaryDrawerTrait.php you define the draw function for the shape Line.
 2. The last thing is to add the shape app/Shapes/Line.php with the
    right functions definitions.

### Add more attributes

Optionally, you can add attributes too, let's say you wanna add the sideLenght that accept values in different units: px, cm.. the only thing you'll have to do is to add a class **app/Shapes/Attributes/SideLenght.php** and make sure it extends the class **app/Shapes/Attributes/AttributeAbstract.php** then
the application will load it automatically when it detects it.


