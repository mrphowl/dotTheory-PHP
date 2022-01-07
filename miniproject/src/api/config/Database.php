<?php

/**
 * Class to connect to the database.
 */
final class Database {
    /**
     * @var string $conn_string
     */
    private $dbtype = 'mysql';
    
    /**
     * @var string $hostname
     */
    private $hostname = 'localhost';
    
    /**
     * @var int $port
     */
    private $port = 3306;

    /**
     * @var string $database
     */
    private $database = '';

    /**
     * @var string $username
     */
    private $username = '';

    /**
     * @var string $password
     */
    private $password = '';

    /**
     * @var resource $conn
     */
    public $conn;

    /**
     * Constructor
     * 
     * @param string $hostname
     * @param string $username
     * @param string $password
     */
    public function __construct($dbconfig = []) {
        if(isset($dbconfig['dbtype'])) {
            $this->dbtype = $dbconfig['dbtype'];
        }
        if(isset($dbconfig['dbhost'])) {
            $this->hostname = $dbconfig['dbhost'];
        }
        if(isset($dbconfig['dbuser'])) {
            $this->username = $dbconfig['dbuser'];
        }
        if(isset($dbconfig['dbpassword'])) {
            $this->password = $dbconfig['dbpassword'];
        }
        if(isset($dbconfig['dbport'])) {
            $this->port = $dbconfig['dbport'];
        }
        if(isset($dbconfig['dbname'])) {
            $this->database = $dbconfig['dbname'];
        }
    }

    /**
     * @return resource
     */
    public function getConnection() {
        $this->conn = null;

        $conn_string = $this->getConnectionString();

        try {
            $this->conn = new PDO($conn_string, $this->username, $this->password);
        }
        catch(PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->conn;
    }

    /**
     * @return string
     */
    public function getConnectionString() {
        return $this->dbtype . ':host=' . $this->hostname . ';port=' . $this->port . ';dbname=' . $this->database;
    }
}