
<?php

// ==================== STRINGS ====================

echo "<h2>Strings</h2>";

// Question 1: Convert string into an array
$string = "Twinkle, twinkle, little star.";
$array = explode(" ", $string);

echo "<h3>Question 1</h3><pre>";
var_dump($array);
echo "</pre>";

// Question 2: Get the next letter
$letter = 'a';

if ($letter == 'z') {
    $nextLetter = 'a';
} else {
    $nextLetter = chr(ord($letter) + 1);
}

echo "<h3>Question 2</h3>";
echo $nextLetter;

// Question 3: Insert "quick" after "The"
$original = "The brown fox";
$result = substr_replace($original, "quick ", 4, 0);

echo "<h3>Question 3</h3>";
echo $result;

// Question 4: Get the first word
$sentence = "The quick brown fox";
$words = explode(" ", $sentence);

echo "<h3>Question 4</h3>";
echo $words[0];

// Question 5: Remove leading zeros
$number = "0000657022.24";
$result = ltrim($number, '0');

echo "<h3>Question 5</h3>";
echo $result;

// Question 6: Remove trailing dashes
$sentence = "The quick brown fox jumps over the lazy dog---";
$result = rtrim($sentence, '-');

echo "<h3>Question 6</h3>";
echo $result;

// Question 7: Get the first five words
$sentence = "The quick brown fox jumps over the lazy dog";
$words = explode(" ", $sentence);
$firstFive = array_slice($words, 0, 5);
$result = implode(" ", $firstFive);

echo "<h3>Question 7</h3>";
echo $result;

// Question 8: Remove the comma
$number = "2,543.12";
$result = str_replace(",", "", $number);

echo "<h3>Question 8</h3>";
echo $result;


// ==================== LOOPS ====================

echo "<h2>Loops</h2>";

// Question 1: Fibonacci sequence (first 10 numbers)
$first = 0;
$second = 1;
$n = 10;

echo "<h3>Question 1: Fibonacci Sequence</h3>";

for ($i = 0; $i < $n; $i++) {
    echo $first;

    if ($i < $n - 1) {
        echo ", ";
    }

    $next = $first + $second;
    $first = $second;
    $second = $next;
}

// Question 2: Floyd's Triangle
$n = 5;
$number = 1;

echo "<h3>Question 2: Floyd's Triangle</h3>";
echo "<pre>";

for ($i = 1; $i <= $n; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $number . " ";
        $number++;
    }

    echo "\n";
}

echo "</pre>";

// Question 3: Alphabet Pattern
echo "<h3>Question 3: Alphabet Pattern</h3>";
echo "<pre>";

for ($i = 1; $i <= 5; $i++) {
    for ($j = 0; $j < $i; $j++) {
        echo chr(65 + $j) . " ";
    }

    echo "\n";
}

for ($i = 4; $i >= 1; $i--) {
    for ($j = 0; $j < $i; $j++) {
        echo chr(65 + $j) . " ";
    }

    echo "\n";
}

echo "</pre>";


// ==================== LOGICAL STATEMENTS ====================

echo "<h2>Logical Statements and Operators</h2>";

// Question 1: Check whether a year is a leap year
$year = 2013;

echo "<h3>Question 1: Leap Year</h3>";

if (($year % 400 == 0) ||
    ($year % 4 == 0 && $year % 100 != 0)) {
    echo "This year is a leap year.";
} else {
    echo "This year is not a leap year.";
}

// Question 2: Check the season using temperature
$temperature = 27;

echo "<h3>Question 2: Season</h3>";

if ($temperature < 20) {
    echo "It is wintertime!";
} else {
    echo "It is summertime!";
}

// Question 3: Sum two integers and triple the sum if equal
$firstInteger = 2;
$secondInteger = 2;
$sum = $firstInteger + $secondInteger;

echo "<h3>Question 3: Sum of Integers</h3>";

if ($firstInteger == $secondInteger) {
    $result = $sum * 3;
    echo "The result is: " . $result;
} else {
    echo "The sum is: " . $sum;
}

// Question 4: Find numbers from 200 to 250 divisible by 4
echo "<h3>Question 4: Numbers Divisible by 4</h3>";

for ($i = 200; $i <= 250; $i++) {
    if ($i % 4 == 0) {
        echo $i . " ";
    }
}

// Question 5: Display 10 random unique numbers from 11 to 20
echo "<h3>Question 5: Random Numbers</h3>";

$numbers = range(11, 20);
shuffle($numbers);

$numbers = array_slice($numbers, 0, 10);

echo implode(" ", $numbers);

?>
