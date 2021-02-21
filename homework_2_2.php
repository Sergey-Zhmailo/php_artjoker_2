<?php
/*Создать класс “Фигура” унаследовать от него три класса “Прямоугольник”, “Треугольник” и “Круг”. Посчитать периметр и площадь фигуры. Объяснить на примере суть полиморфизма. Некорректные входные данные, обработать исключительными ситуациями. Нарисовать UML-диаграмму классов (интерфейсов).

Cуть полиморфизма: объявив один метод для всех наследников, мы можем его выполнять не беспокоясь, что это будет за наследник.
UML диаграмма - Class Diagram 2_2.jpg

*/

abstract class Shape {

    public function __construct()
    {

    }

    public abstract function perimetr();
    public abstract function square();
}

class Rectangle extends Shape {
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        if ($width === 0 || $height === 0) {
            throw new Exception("Width or height equal 0");
        }
        if ($width < 0 || $height < 0) {
            throw new Exception("Width or height less than 0");
        }

        parent::__construct();
        $this->width = $width;
        $this->height =$height;
    }

    public function perimetr() {
        return ($this->width + $this->height) * 2;
    }
    public function square() {
        return $this->width * $this->height;
    }

}
class Triangle extends Shape {
    private $widthA;
    private $widthB;
    private $widthC;
    private $heightA;

    public function __construct($widthA, $widthB, $widthC, $heightA)
    {
        if ($widthA <= 0) {
            throw new Exception("Width A is equal or less than 0");
        }
        if ($widthB <= 0) {
            throw new Exception("Width B is equal or less than 0");
        }
        if ($widthB <= 0) {
            throw new Exception("Width C is equal or less than 0");
        }
        if ($heightA <= 0) {
            throw new Exception("Height A is equal or less than 0");
        }

        parent::__construct();
        $this->widthA = $widthA;
        $this->widthB = $widthB;
        $this->widthC = $widthC;
        $this->heightA =$heightA;
    }

    public function perimetr() {
        return $this->widthA + $this->widthB + $this->widthC;
    }
    public function square() {
        return $this->widthA * $this->heightA / 2;
    }
}
class Circle extends Shape {
    private $radius;

    public function __construct($radius)
    {
        if ($radius <= 0) {
            throw new Exception("Radius is equal or less than 0");
        }

        parent::__construct();
        $this->radius = $radius;
    }

    public function perimetr(){
        return 2 * M_PI * $this->radius;
    }
    public function square()
    {
        return M_PI * pow($this->radius, 2);
    }

}

try {
    $rectangle = new Rectangle(2, 3);
    echo $rectangle->perimetr() . '<br/>';
    echo $rectangle->square() . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

try {
    $triangle = new Triangle(5, 3, 2, 3);
    echo $triangle->perimetr() . '<br/>';
    echo $triangle->square() . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

try {
    $circle = new Circle(5);
    echo $circle->perimetr() . '<br/>';
    echo $circle->square() . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}
