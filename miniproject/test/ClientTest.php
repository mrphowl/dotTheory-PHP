<?php
/**
 * Unit test for Database class.
 */
use PHPUnit\Framework\TestCase;

require_once('src\api\config\Database.php');
require_once('src\api\object\Client.php');

class ClientTest extends TestCase {
    private $config = [
        'dbtype' => 'mysql',
        'dbhost' => 'localhost',
        'dbname' => 'php_training',
        'dbuser' => 'dottheoryphpuser',
        'dbpassword' => 'dottheoryphp',
        'dbport' => 3306,
    ];

    public function testInitializeProperties() {
        $db_connector = new Database($this->config);
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);

        $this->assertNull($client->id, 'Property `id` should be null by default');
        $this->assertNull($client->firstname, 'Property `firstname` should be null by default');
        $this->assertNull($client->lastname, 'Property `lastname` should be null by default');
        $this->assertNull($client->middlename, 'Property `middlename` should be null by default');
        $this->assertNull($client->date_visited, 'Property `date_visited` should be null by default');
        $this->assertNull($client->birthday, 'Property `birthday` should be null by default');
        $this->assertNull($client->street, 'Property `street` should be null by default');
        $this->assertNull($client->city, 'Property `city` should be null by default');
        $this->assertNull($client->province, 'Property `province` should be null by default');
        $this->assertNull($client->email, 'Property `email` should be null by default');
        $this->assertNull($client->store_id, 'Property `store_id` should be null by default');
        $this->assertNull($client->storesVisited, 'Property `storesVisited` should be null by default');
    }

    public function testDefaultTableFields() {
        $expected = 'id, firstname, middlename, lastname, date_visited, birthday, street, city, province, email, store_id';
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        $this->assertSame($expected, $client->getSelectFields());
    }

    public function testCreate() {
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);

        $client->id = null;
        $client->firstname = 'Sakura';
        $client->lastname = 'Shinguji';
        $client->middlename = '';
        $client->birthday = '1905-07-28';
        $client->datevisited = null;
        $client->street = '';
        $client->city = '';
        $client->probvince = '';
        $client->email = '';

        $this->assertEquals(true, $client->create());
    }

    public function testGetRecords() {
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        $cond = ['firstname' => 'Sakura'];
        $result = $client->getRecords($cond);
                
        $this->assertEquals(4, count($result));
    }

    public function testGetRecordById() {
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        $client->getRecordById(5);
                
        $this->assertEquals(5, $client->id);
    }

    public function testUpdate() {
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        $client->getRecordById(5);
        $client->street = '1 way';
        $this->assertEquals(1, $client->update());
    }

    public function testDelete() {
        // --TODO: Mock database connection
        $db_connector = new Database($this->config);
        $conn = $db_connector->getConnection();
        $client = new Client($conn);
        
        $this->assertEquals(1, $client->delete(6));
    }
}