<?php

function fibonacciSequence($n) {
    if ($n <= 0 || $n > 20) {
        return "Invalid input. Please provide a number between 1 and 20.";
    }
    $fibonacci = array(0, 1);
    
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    return implode(', ', $fibonacci);
}

$input = 20;
$output = fibonacciSequence($input);
echo "Input: " . $input . ", Output: " . $output;


