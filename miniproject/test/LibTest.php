<?php
/**
 * Unit test for Database class.
 */
use PHPUnit\Framework\TestCase;

require_once('lib.php');

class LibTest extends TestCase {
    public function testSanitizeParam() {
        $param = "<br>Clean<br>";
        $this->assertSame("Clean", sanitize($param));
    }
}