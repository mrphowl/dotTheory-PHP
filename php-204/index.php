<?php
/**
 * PHP 204 Practical Exam
 * 
 * Check whether a passed string is a palindrome.
 */

/**
 * Check if string is a palindrome.
 * Returns 1 if $string is a palindrome otherwise, returns 0.
 * 
 * @param string $string
 * @return int
 */
function is_palindrome($string) {

    // return strrev($string) === $string ? 1 : 0;
    if(strrev($string) === $string) {
        return 1;
    }

    return 0;
}

$string = 'madam';

print_r(is_palindrome($string));
?>