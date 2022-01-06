<?php
/**
 * PHP 403 Practical Exam
 * 
 * Unit testing
 */
use PHPUnit\Framework\TestCase;

require_once('src\Calculator.php');
/**
 * Test class for the Calculator class.
 */
class CalculatorTest extends TestCase {
    public function testAddition() {
        $calc = new Calculator;
        $sum = $calc->add(17, 19);
        $this->assertEquals(36, $sum);
    }

    public function testSubtraction() {
        $calc = new Calculator;
        $diff = $calc->subtract(42, 15);
        $this->assertEquals(27, $diff);
    }

    public function testMultiplicaiton() {
        $calc = new Calculator;
        $product = $calc->multiply(25, 36);
        $this->assertEquals(900, $product);
    }

    public function testDivision() {
        $calc = new Calculator;
        $quotient = $calc->divide(36, 6);
        $this->assertEquals(6, $quotient);
    }

}