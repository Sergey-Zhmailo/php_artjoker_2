<?php
/* Написать функцию которая по параметрам принимает число из десятичной системы счисления и преобразовывает в двоичную. Написать функцию которая выполняет преобразование наоборот.
*/

echo '<br/>' . '==========#1==========' . '<br/>';
function decimalToBinary($number) {
    if (!is_numeric($number)) {
        throw new Exception('Enter number');
    }
    if ($number == 0) {
        return 0;
    }
    return (10 * decimalToBinary($number / 2) + $number % 2);
}
try {
    $decimRes = decimalToBinary('asd');
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}
echo 'decimalToBinary - ' . $decimRes . '<br/>';

function binaryToDecimal($number, $i = 0) {
    $number = (string)$number;

    if (preg_match('/[^0-1]/', $number)) {
        throw new Exception('Only 1 and 0');
    }

    $numberLength = strlen($number);
    $res = 0;

    if ($i < $numberLength) {
        $res = intval($number[$i]) * pow(2, $numberLength - $i - 1);
        ++$i;
        return $res + binaryToDecimal($number, $i);
    }

    return $res;
}
try {
    $binaryRes = binaryToDecimal(10111);
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}
echo 'binaryToDecimal - ' . $binaryRes . '<br/>';

/*Написать функцию которая выводит первые N чисел фибоначчи*/
echo '<br/>' . '==========#2==========' . '<br/>';

function getFibbonaci($n) {
//    Fn = Fn-1 + Fn-2
    $res = [0, 1];
    for ($i = 2; $i < $n; $i++) {
        $res[$i] = ($res[$i - 1] + $res[$i - 2]);
    }
    echo 'Fibbonaci: ' . implode(',', $res);
}
getFibbonaci(8);

/*Написать функцию, возведения числа N в степень M*/
echo '<br/>' . '==========#3==========' . '<br/>';
function powNToM($n, $m){
    if ($m < 0) {
        return powNToM( 1 / $n, -$m);
    }
    if ($m == 0) {
        return 1;
    }
    return $n * powNToM($n, $m - 1);
}
$res = powNToM(2, 3);
echo $res;

/*Написать функцию которая вычисляет входит ли IP-адрес в диапазон указанных IP-адресов. Вычислить для версии ipv4*/
echo '<br/>' . '==========#4==========' . '<br/>';
$ipArr = ['1.127.255.100', '128.0.0.0'];
$ipCheck = '1.128.0.0';

function checkIp($ip, $ipArr) {
    if (!preg_match('/^(?=\d+\.\d+\.\d+\.\d+$)(?:(?:25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]|[0-9])\.?){4}$/', $ip)) {
        throw new Exception('IP format must be 000.000.000.000');
    }

    $ipArr = $ipArr;
    $ip = $ip;

    $ipRangeStart = ip2long($ipArr[0]);
    $ipRangeEnd = ip2long($ipArr[1]);
    $ipCheck = ip2long($ip);

    if ($ipCheck >= $ipRangeStart && $ipCheck <= $ipRangeEnd) {
        return 'IP allowed';
    } else {
        return 'IP denied';
    }
}
try {
    echo checkIp($ipCheck, $ipArr);
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

/*Для одномерного массива
Подсчитать процентное соотношение положительных/отрицательных/нулевых/простых чисел
Отсортировать элементы по возрастанию/убыванию*/
echo '<br/>' . '==========#5==========' . '<br/>';

$baseArr = [0, 2, 15, 22, 7, 1, 35, 16, 3, -3, -2, 17];

function percentagePositiveNumbers($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arr = $numbersArr;

    foreach ($arr as $arrItem) {
        if ($arrItem > 0) {
            $positiveNumbersArr[] = $arrItem;
        }
    }
    $percentagePositiveNumbers = round((count($positiveNumbersArr) / count($arr) * 100));
    return $percentagePositiveNumbers;
}

try {
    echo 'Positive (%): ' . percentagePositiveNumbers($baseArr) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}


function percentageNegativeNumbers($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arr = $numbersArr;

    foreach ($arr as $arrItem) {
        if ($arrItem < 0) {
            $negativeNumbersArr[] = $arrItem;
        }
    }
    $percentageNegativeNumbers = round((count($negativeNumbersArr) / count($arr) * 100));
    return $percentageNegativeNumbers;
}
try {
    echo 'Negative (%): ' . percentageNegativeNumbers($baseArr) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

function percentageZero($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arr = $numbersArr;
    foreach ($arr as $arrItem) {
        if ($arrItem == 0) {
            $zeroArr[] = $arrItem;
        }
    }
    $percentageZero = round((count($zeroArr) / count($arr) * 100));
    return $percentageZero;
}

try {
    echo 'Zero (%): ' . percentageZero($baseArr) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

function isPrimeNumber($number) {
    $isPrime = true;
    if ($number > 1) {
        for ($i = 2; $i < $number; $i++) {
            if ($number % $i == 0) {
                $isPrime = false;
                return $isPrime;
            }
        }
    } else {
        $isPrime = false;
    }
    return $isPrime;
}

function percentagePrimeNumbers($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arr = $numbersArr;
    foreach ($arr as $arrItem) {
        if (isPrimeNumber($arrItem)) {
            $primeNumbersArr[] = $arrItem;
        }
    }
    $percentagePrimeNumbers = round((count($primeNumbersArr) / count($arr) * 100));
    return $percentagePrimeNumbers;
}

try {
    echo 'Prime (%): ' . percentagePrimeNumbers($baseArr) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

function arrSortAsc($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arrSize = count($numbersArr);
    for($i = 0; $i < $arrSize; $i ++) {
        for($j = 0; $j < $arrSize; $j ++) {
            if ($numbersArr[$i] < $numbersArr[$j]) {
                $item = $numbersArr[$i];
                $numbersArr[$i] = $numbersArr[$j];
                $numbersArr[$j] = $item;
            }
        }

    }
    return $numbersArr;
}

try {
    echo 'Sort array asc: ' . implode(',', arrSortAsc($baseArr)) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

function arrSortDesc($numbersArr) {
    if (count($numbersArr) == 0) {
        throw new Exception('Empty array');
    }

    $arrSize = count($numbersArr);
    for($i = 0; $i < $arrSize; $i ++) {
        for($j = 0; $j < $arrSize; $j ++) {
            if ($numbersArr[$i] > $numbersArr[$j]) {
                $item = $numbersArr[$i];
                $numbersArr[$i] = $numbersArr[$j];
                $numbersArr[$j] = $item;
            }
        }

    }
    return $numbersArr;
}

try {
    echo 'Sort array desc: ' . implode(',', arrSortDesc($baseArr)) . '<br/>';
} catch (Exception $e) {
    echo $e->getMessage() . '<br/>';
}

/*
 * Для двумерных массивов
Транспонировать матрицу
Умножить две матрицы
Удалить те строки, в которых сумма элементов положительна и присутствует хотя бы один нулевой элемент. Аналогично для столбцов.

 * */
echo '<br/>' . '==========#6==========' . '<br/>';

$baseArr = [
    ['1a', '2a'],
    ['1b', '2b'],
    ['1c', '2c']
];

function transpose($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < count($arr[$i]); $j++) {
            $res[$j][$i] = $arr[$i][$j];
        }
    }
    return $res;
}
echo '<pre>';
var_dump(transpose($baseArr));
echo '</pre>';

function multiplyMatrix($multiplierArr1, $multiplierArr2) {
    for ($i = 0; $i < count($multiplierArr1); $i++) {
        for ($j = 0; $j < count($multiplierArr1[$i]); $j++) {
            $res[$i][$j]=0;
            for($k = 0; $k < count($multiplierArr2); $k++){
                $res[$i][$j] += $multiplierArr1[$i][$k] * $multiplierArr2[$k][$j];
            }
        }
    }
    return $res;
}
$arr1 = [
    [2, 3, 5],
    [1, 6, 7]
];
$arr2 = [
    [3, 2, 8],
    [0, 7, 4]
];
echo '<pre>';
var_dump(multiplyMatrix($arr1, $arr2));
echo '</pre>';

function deleteMatrixRow($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        $rowSum = 0;
        $isZero = false;
        for ($j = 0; $j < count($arr[$i]); $j++) {
            $rowSum += $arr[$i][$j];
            if ($arr[$i][$j] == 0) {
                $isZero = true;
            }
        }
        if (!($rowSum > 0 && $isZero)) {
            $res[] = $arr[$i];
        }

    }
    return $res;
}
$deleteMatrixRowInputArr = [
    [2, 3, 5],
    [0, 7, 4],
    [1, 6, 7]
];
echo '<pre>';
var_dump(deleteMatrixRow($deleteMatrixRowInputArr));
echo '</pre>';

function deleteMatrixCol($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        $colSum = 0;
        $isZero = false;
        for ($j = 0; $j < count($arr[$i]); $j++) {
            $colSum += $arr[$j][$i];
            if ($arr[$j][$i] == 0) {
                $isZero = true;
            }
        }
        if (!($colSum > 0 && $isZero)) {
            for ($k = 0; $k < count($arr[$i]); $k++) {
                $res[$k][] = $arr[$k][$i];
            }
        }
    }
    return $res;
}
$deleteMatrixColInputArr = [
    [2, 3, 5],
    [0, -7, 4],
    [1, -6, 7]
];
echo '<pre>';
var_dump(deleteMatrixCol($deleteMatrixColInputArr));
echo '</pre>';

/*Рекурсии
Все задачи на циклы которые можно реализовать с помощью рекурсии, переписать с помощью рекурсивных функций
Написать рекурсивную функцию которая будет обходить и выводить все значения любого массива и любого уровня вложенности*/
echo '<br/>' . '==========#7==========' . '<br/>';

function showArrayValues($arr) {
    for ($i = 0; $i < count($arr); $i++) {
        if (is_array($arr[$i])) {
            showArrayValues($arr[$i]);
        } else {
            echo $arr[$i] . '<br/>';
        }
    }
}

$baseArray = [
    1,
    '2',
    ['q', 4, 5],
    [
        6,
        ['t', 7]
    ]
];
showArrayValues($baseArray);