<?php
/**
 * Unit test for Database class.
 */
use PHPUnit\Framework\TestCase;

require_once('src\api\config\Database.php');
require_once('src\api\object\Client.php');

class ClientTest extends TestCase {
    public function testDefaultTableFields() {
        $config = [
            'dbtype' => 'mysql',
            'dbhost' => 'localhost',
            'dbname' => 'php_training',
            'dbuser' => 'dottheoryphpuser',
            'dbpassword' => 'dottheoryphp',
            'dbport' => 3306,
        ];
        $db_connector = new Database($config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        $expected = 'c.id, c.firstname, c.middlename, c.lastname, c.datevisited, c.birthday, c.street, c.city, c.province, c.email';
        $this->assertSame($expected, $client->getSelectFields());
    }
}