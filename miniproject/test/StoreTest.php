<?php
/**
 * Unit test for Database class.
 */
use PHPUnit\Framework\TestCase;

require_once('src\api\config\Database.php');
require_once('src\api\object\Store.php');

class StoreTest extends TestCase {
    private $config = [
        'dbtype' => 'mysql',
        'dbhost' => 'localhost',
        'dbname' => 'php_training',
        'dbuser' => 'dottheoryphpuser',
        'dbpassword' => 'dottheoryphp',
        'dbport' => 3306,
    ];

    public function testInitProperties() {
        $db_connector = new Database($this->config);
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $store = new Store($conn);

        $this->assertNull($store->id, 'Property `id` should be null by default');
        $this->assertNull($store->name, 'Property `name` should be null by default');
    }

    public function testGetRecordById() {
        $db_connector = new Database($this->config);
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $store = new Store($conn);

        $store->getRecordById(1);
        $this->assertEquals(1, $store->id);
        $this->assertEquals('SM DEPARTMENT STORE', $store->name);
    }

    public function testgetStoreName() {
        $db_connector = new Database($this->config);
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $store = new Store($conn);

        $this->assertSame('SM DEPARTMENT STORE', $store->getStoreName(1));

    }
}