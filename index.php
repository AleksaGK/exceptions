<?php


function multiply($a, $b)
{
    return $a * $b;
}

class Calculator
{
    public function add($a, $b)
    {
        if ($a + $b > PHP_INT_MAX)
            throw new LengthException("Can't display a number");
        return $a + $b;
    }

    public function add2($a, $b)
    {
        try {
            if ($this->checkNumber($a) && $this->checkNumber($b))
                return $a + $b;
        } catch (LogicException $e) {
            echo "LogicException in add2: " . $e->getMessage();
        }
    }

    private function checkNumber($a)
    {
        if ($a < PHP_INT_MIN || $a > PHP_INT_MAX)
            throw new RangeException('Number out of range');
        return true;
    }

    public function subtract($a, $b)
    {
        if (!is_numeric($a) || !is_numeric($b))
            throw new InvalidArgumentException("Both arguments must be numeric");
        return $a - $b;
    }

    public function divide($a, $b)
    {
        if ($b == 0)
            throw new DomainException('Division by zero.');
        return $a / $b;
    }

    public function multiply($a, $b)
    {
        $p = $a * $b;
        if ($p > PHP_INT_MAX) {
            throw new OverflowException('The product exceeds the maximum value');
        }
        return $p;
    }

    public function performOperation($function, $a, $b)
    {
        if (!is_callable($function)) {
            throw new BadFunctionCallException("Invalid function: $function");
        }
        return call_user_func($function, $a, $b);
    }

    public function performOperation2($method, $a, $b)
    {
        switch ($method) {
            case 'add':
                return $this->add($a, $b);
            case 'subtract':
                return $this->subtract($a, $b);
            default:
                throw new BadMethodCallException("Invalid method: $method");
        }
    }
}


try {
    $calculator = new Calculator();
    // $result = $calculator->divide(10, 0);
    // $result = $calculator->performOperation('multiply', 5, 10);
    // $result = $calculator->performOperation2('divide', 5, 10);
    // $result = $calculator->divide(2, 0);
    // $result = $calculator->subtract(2, 0);
    // $result = $calculator->add(PHP_INT_MAX, PHP_INT_MAX);
    // $result = $calculator->multiply(2, PHP_INT_MAX);
    $result = $calculator->add2(2, PHP_INT_MAX + PHP_INT_MAX);
    echo "Result: $result";
    $result = $calculator->add(2, 5);
    echo "Result: $result";
} catch (LogicException $e) {
    echo "LogicException: " . $e->getMessage();
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
} catch (TypeError $e) {
    echo "TypeError: " . $e->getMessage();
} finally {
    echo "<br>finally";
}



































// //Exception
// $prva = 10;
// $druga = 0;
// $niz = [1, 2, 3];

// try {
//     echo $prva / $druga;
// } catch (Error $e) {
//     echo $e;
// }
