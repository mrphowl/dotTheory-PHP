<?php
/**
 * PHP 403 Practical Exam
 * 
 * Unit testing
 * 
 * Create a Calculator class that has he basic methods of addition, sutraction,
 *  multiplication, and division.
 * Create a CalculatorTest class that will contain the unit test.
 */
class Calculator {
    /**
     * Addition method
     * 
     * Compute the sum of two integers.
     * 
     * @param int $add1
     * @param int $add2
     * @return int
     * 
     */
    public function add(int $add1, int $add2) {
        return $add1 + $add2;
    }

    /**
     * Subtraction method
     * 
     * Compute the difference between two integers.
     * 
     * @param int $minuend
     * @param int $subtrahend
     * @return int
     * 
     */
    public function subtract(int $minuend, int $subtrahend) {
        return $minuend - $subtrahend;
    }

    /**
     * Multiplication method
     * 
     * Compute the product of two integers.
     * 
     * @param int $multipicand
     * @param int $multiplier
     * @return int
     * 
     */
    public function multiply(int $multipicand, int $multiplier) {
        return $multipicand * $multiplier;
    }

    /**
     * Division method
     * 
     * Compute the quotient.
     * 
     * @param int $dividend
     * @param int $divisor
     * @return float
     * 
     * @throws Exception when $divisor is 0
     * 
     */
    public function divide(int $dividend, int $divisor) {
        if($divisor == 0) {
            throw new Exception('Error: cannot divide by zero (0).');
        }
        return $dividend / $divisor;
    }
}
