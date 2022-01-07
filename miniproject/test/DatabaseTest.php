<?php
/**
 * Unit test for Database class.
 */
use PHPUnit\Framework\TestCase;

require_once('src\api\config\Database.php');

class DatabaseTest extends TestCase {
    public function testCreateConnectionString() {
        $config = [
            'dbtype' => 'mysql',
            'dbhost' => 'localhost',
            'dbname' => 'php_training',
            'dbport' => 3306,
        ];
        $db_connector = new Database($config);
        $conn_string = $db_connector->getConnectionString();
        $this->assertEquals('mysql:host=localhost;port=3306;dbname=php_training', $conn_string);
    }
}