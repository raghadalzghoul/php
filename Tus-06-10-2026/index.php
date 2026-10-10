
<?php

// ==================================================
// 1. ARRAYS
// ==================================================

echo "<h2>Arrays</h2>";

// Question 1: Display colors as an unordered list
$colors = array('white', 'green', 'red');
sort($colors);

echo "<h3>Array 1: Colors</h3>";
echo "<ul>";
foreach ($colors as $color) {
    echo "<li>$color</li>";
}
echo "</ul>";


// Question 2: Display countries and capitals, sorted by capital
$cities = array(
    "Italy" => "Rome",
    "Luxembourg" => "Luxembourg",
    "Belgium" => "Brussels",
    "Denmark" => "Copenhagen",
    "Finland" => "Helsinki",
    "France" => "Paris",
    "Slovakia" => "Bratislava",
    "Slovenia" => "Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland" => "Dublin",
    "Netherlands" => "Amsterdam",
    "Portugal" => "Lisbon",
    "Spain" => "Madrid"
);

asort($cities);

echo "<h3>Array 2: Countries and Capitals</h3>";
foreach ($cities as $country => $capital) {
    echo "The capital of $country is $capital<br>";
}


// Question 3: Display the first element
$color = array(
    4 => 'white',
    6 => 'green',
    11 => 'red'
);

echo "<h3>Array 3: First Element</h3>";
echo reset($color);


// Question 4: Insert an item at a specific position
$array = array(1, 2, 3, 4, 5);
$location = 4;
$newItem = '$';

// Position 4 means insert before the fourth element
array_splice($array, $location - 1, 0, $newItem);

echo "<h3>Array 4: Insert an Item</h3>";
echo implode(" ", $array);


// Question 5: Sort an associative array by its values
$fruits = array(
    "d" => "lemon",
    "a" => "orange",
    "b" => "banana",
    "c" => "apple"
);

asort($fruits);

echo "<h3>Array 5: Sort Fruits by Value</h3>";
foreach ($fruits as $key => $fruit) {
    echo "$key = $fruit<br>";
}


// Question 6: Average, seven lowest and seven highest temperatures
$temperatures = array(
    78, 60, 62, 68, 71, 68, 73, 85, 66, 64,
    76, 63, 75, 76, 73, 68, 62, 73, 72, 65,
    74, 62, 62, 65, 64, 68, 73, 75, 79, 73
);

$average = array_sum($temperatures) / count($temperatures);

sort($temperatures);

$lowest = array_slice($temperatures, 0, 7);
$highest = array_slice($temperatures, -7);

echo "<h3>Array 6: Temperatures</h3>";
echo "Average Temperature is: " . round($average, 1) . "<br>";
echo "Seven lowest temperatures: " . implode(", ", $lowest) . "<br>";
echo "Seven highest temperatures: " . implode(", ", $highest) . "<br>";


// Question 7: Merge two arrays
$array1 = array("color" => "red", 2, 4);
$array2 = array("a", "b", "color" => "green",
                "shape" => "trapezoid", 4);

$merged = array_merge($array1, $array2);

echo "<h3>Array 7: Merge Arrays</h3><pre>";
print_r($merged);
echo "</pre>";


// Question 8: Convert all strings to uppercase
$colors = array("red", "blue", "white", "yellow");

$colors = array_map('strtoupper', $colors);

echo "<h3>Array 8: Uppercase Colors</h3><pre>";
print_r($colors);
echo "</pre>";


// ==================================================
// 2. FUNCTIONS
// ==================================================

echo "<h2>Functions</h2>";


// Question 1: Check if a number is prime
function isPrime($number) {
    if ($number < 2) {
        return false;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

$n = 3;

echo "<h3>Function 1: Prime Number</h3>";

if (isPrime($n)) {
    echo "$n is a prime number";
} else {
    echo "$n is not a prime number";
}


// Question 2: Reverse a string
function reverseString($text) {
    return strrev($text);
}

echo "<h3>Function 2: Reverse String</h3>";
echo reverseString("remove");


// Question 3: Swap two variables
function swapVariables(&$x, &$y) {
    $temp = $x;
    $x = $y;
    $y = $temp;
}

$x = 12;
$y = 10;

swapVariables($x, $y);

echo "<h3>Function 3: Swap Variables</h3>";
echo "x = $x, y = $y";


// Question 4: Check Armstrong number
function isArmstrong($number) {
    $digits = str_split((string)$number);
    $sum = 0;

    foreach ($digits as $digit) {
        $sum += $digit * $digit * $digit;
    }

    return $sum == $number;
}

$n = 407;

echo "<h3>Function 4: Armstrong Number</h3>";

if (isArmstrong($n)) {
    echo "$n is an Armstrong Number";
} else {
    echo "$n is not an Armstrong Number";
}


// Question 5: Check palindrome
function isPalindrome($text) {
    $text = strtolower($text);

    // Remove spaces and punctuation
    $text = preg_replace('/[^a-z0-9]/', '', $text);

    return $text == strrev($text);
}

$sentence = "Eva, can I see bees in a cave?";

echo "<h3>Function 5: Palindrome</h3>";

if (isPalindrome($sentence)) {
    echo "Yes, it is a palindrome";
} else {
    echo "No, it is not a palindrome";
}


// Question 6: Remove duplicates from an array
function removeDuplicates($array) {
    return array_values(array_unique($array));
}

$array1 = array(2, 4, 7, 4, 8, 4);
$array1 = removeDuplicates($array1);

echo "<h3>Function 6: Remove Duplicates</h3><pre>";
print_r($array1);
echo "</pre>";


// ==================================================
// 3. LOGICAL STATEMENTS AND OPERATORS
// ==================================================

echo "<h2>Logical Statements and Operators</h2>";


// Question 1: Check whether the sum equals 30
function sumEquals30($firstInteger, $secondInteger) {
    $sum = $firstInteger + $secondInteger;

    if ($sum == 30) {
        return $sum;
    }

    return false;
}

$result = sumEquals30(10, 10);

echo "<h3>Logic 1: Sum Equals 30</h3>";
var_export($result);
echo "<br>";


// Question 2: Check whether a number is a multiple of 3
$number = 20;

echo "<h3>Logic 2: Multiple of 3</h3>";

if ($number > 0 && $number % 3 == 0) {
    echo "true";
} else {
    echo "false";
}


// Question 3: Check if number is between 20 and 50
$number = 50;

echo "<h3>Logic 3: Range 20 to 50</h3>";

if ($number >= 20 && $number <= 50) {
    echo "true";
} else {
    echo "false";
}


// Question 4: Find the largest of three numbers
$a = 1;
$b = 5;
$c = 9;

$largest = max($a, $b, $c);

echo "<h3>Logic 4: Largest Number</h3>";
echo $largest;


// Question 5: Calculate the electricity bill
function electricityBill($units) {
    $bill = 0;

    if ($units <= 50) {
        $bill = $units * 2.50;
    } elseif ($units <= 150) {
        $bill = (50 * 2.50) + (($units - 50) * 5.00);
    } elseif ($units <= 250) {
        $bill = (50 * 2.50) + (100 * 5.00)
              + (($units - 150) * 6.20);
    } else {
        $bill = (50 * 2.50) + (100 * 5.00)
              + (100 * 6.20) + (($units - 250) * 7.50);
    }

    return $bill;
}

$units = 200;

echo "<h3>Logic 5: Electricity Bill</h3>";
echo "Bill: " . number_format(electricityBill($units), 2) . " JOD";


// Question 6: Calculator with four operations
function calculator($num1, $num2, $operator) {
    switch ($operator) {
        case '+':
            return $num1 + $num2;

        case '-':
            return $num1 - $num2;

        case '*':
            return $num1 * $num2;

        case '/':
            if ($num2 == 0) {
                return "Cannot divide by zero";
            }
            return $num1 / $num2;

        default:
            return "Invalid operator";
    }
}

echo "<h3>Logic 6: Calculator</h3>";
echo "10 + 5 = " . calculator(10, 5, '+') . "<br>";
echo "10 - 5 = " . calculator(10, 5, '-') . "<br>";
echo "10 * 5 = " . calculator(10, 5, '*') . "<br>";
echo "10 / 5 = " . calculator(10, 5, '/');


// Question 7: Check voting eligibility
$age = 15;

echo "<h3>Logic 7: Voting Eligibility</h3>";

if ($age >= 18) {
    echo "Eligible to vote";
} else {
    echo "Is not eligible to vote";
}


// Question 8: Positive, negative or zero
$number = -60;

echo "<h3>Logic 8: Positive, Negative or Zero</h3>";

if ($number > 0) {
    echo "Positive";
} elseif ($number < 0) {
    echo "Negative";
} else {
    echo "Zero";
}


// Question 9: Calculate average and find grade
$scores = array(60, 86, 95, 63, 55, 74, 79, 62, 50);

$average = array_sum($scores) / count($scores);

if ($average >= 90) {
    $grade = "A";
} elseif ($average >= 80) {
    $grade = "B";
} elseif ($average >= 70) {
    $grade = "C";
} elseif ($average >= 60) {
    $grade = "D";
} else {
    $grade = "F";
}

echo "<h3>Logic 9: Student Grade</h3>";
echo "Average: " . round($average, 2) . "<br>";
echo "Grade: $grade";


// ==================================================
// 4. LOOPS
// ==================================================

echo "<h2>Loops</h2>";


// Question 1: Display numbers from 1 to 10
echo "<h3>Loop 1: Numbers from 1 to 10</h3>";

for ($i = 1; $i <= 10; $i++) {
    if ($i > 1) {
        echo "-";
    }

    echo $i;
}


// Question 2: Sum integers from 0 to 30
$total = 0;

for ($i = 0; $i <= 30; $i++) {
    $total += $i;
}

echo "<h3>Loop 2: Sum from 0 to 30</h3>";
echo "Total = $total";


// Question 3: Print a triangle pattern
echo "<h3>Loop 3: Triangle Pattern</h3><pre>";

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }

    echo "\n";
}

echo "</pre>";


// Question 4: Print an inverted triangle pattern
echo "<h3>Loop 4: Inverted Triangle</h3><pre>";

for ($i = 5; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }

    echo "\n";
}

echo "</pre>";


// Question 5: Print a diagonal matrix
echo "<h3>Loop 5: Diagonal Matrix</h3><pre>";

for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5; $j++) {
        if ($i == $j) {
            echo $i;
        } else {
            echo "0";
        }

        echo " ";
    }

    echo "\n";
}

echo "</pre>";


// Question 6: Calculate factorial
$n = 5;
$factorial = 1;

for ($i = 1; $i <= $n; $i++) {
    $factorial *= $i;
}

echo "<h3>Loop 6: Factorial</h3>";
echo "$n! = $factorial";


// Question 7: Create a table using nested loops
// Example table: multiplication table from 1 to 5
echo "<h3>Loop 7: Multiplication Table</h3>";

echo '<table border="1" cellpadding="3px" cellspacing="0px">';

for ($i = 1; $i <= 5; $i++) {
    echo "<tr>";

    for ($j = 1; $j <= 5; $j++) {
        echo "<td>" . ($i * $j) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";


// ==================================================
// 5. PHP STRING AND STRING FUNCTIONS
// ==================================================

echo "<h2>String Functions</h2>";


// Question 1: String transformations
$text = "hello orange coding academy";

echo "<h3>String 1: String Transformations</h3>";

echo "Uppercase: " . strtoupper($text) . "<br>";
echo "Lowercase: " . strtolower($text) . "<br>";
echo "First letter uppercase: " . ucfirst($text) . "<br>";
echo "Each word capitalized: " . ucwords($text) . "<br>";


// Question 2: Convert numeric string to time format
$time = "085119";

$formattedTime = substr($time, 0, 2) . ":" .
                 substr($time, 2, 2) . ":" .
                 substr($time, 4, 2);

echo "<h3>String 2: Format Time</h3>";
echo $formattedTime;


// Question 3: Check whether a sentence contains a word
$sentence = "I am a full stack developer at orange coding academy";
$word = "Orange";

echo "<h3>String 3: Search for a Word</h3>";

if (stripos($sentence, $word) !== false) {
    echo "Word Found!";
} else {
    echo "Word Not Found!";
}


// Question 4: Extract the file name from a URL
$url = "www.orange.com/index.php";

$filename = basename($url);

echo "<h3>String 4: Extract File Name</h3>";
echo $filename;


// Question 5: Extract username from an email
$email = "info@orange.com";

$username = strstr($email, "@", true);

echo "<h3>String 5: Extract Email Username</h3>";
echo $username;


// Question 6: Get the last three characters
$text = "info@orange.com";

$lastThree = substr($text, -3);

echo "<h3>String 6: Last Three Characters</h3>";
echo $lastThree;


// Question 7: Generate a random password without rand()
$characters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
$password = "";
$passwordLength = 8;

for ($i = 0; $i < $passwordLength; $i++) {
    $index = random_int(0, strlen($characters) - 1);
    $password .= $characters[$index];
}

echo "<h3>String 7: Random Password</h3>";
echo $password;


// Question 8: Replace the first word of a sentence
$sentence = "That new trainee is so genius.";
$newWord = "the";

$result = preg_replace(
    '/^\S+/',
    $newWord,
    $sentence,
    1
);

echo "<h3>String 8: Replace First Word</h3>";
echo $result;

?>
