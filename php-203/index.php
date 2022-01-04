<?php
/**
 * PHP 203 Practical Exam
 * 
 * Get the first word of a string.
 * Get the first five words from the following string:
 *  "The quick brown fox jumps over the lazy dog"
 * Remove commas from the following numeric string:
 *  "2,543.12"
 */
$string = 'The quick brown fow jumps over the lazy dog';
$numstring = "2,543.12";
$delimiter = ' ';

// get the first word
echo (explode($delimiter, $string))[0];
echo PHP_EOL;
// get the first five words
echo implode(array_slice(explode($delimiter, $string), 0, 5), $delimiter);
echo PHP_EOL;
// remove commas from numeric string
echo str_replace(',', '', $numstring);
?>