<?php
require_once(__DIR__ . '/../../../lib.php');

/**
 * Store class
 */
class Store {
    /**
     * @var int $id
     */
    public $id;
    /**
     * @var string $name
     */
    public $name;

    private $dbconn;

    public function __construct($conn) {
        $this->dbconn = $conn;
        $this->init();
    }

    private function init() {
        $this->id = null;
        $this->name = null;
    }

    public function tableName() {
        return 'stores';
    }

    /**
     * Get one record by $id
     * 
     * @param int $id
     * @return array
     */
    public function getRecordById($id) {
        $sql = 'SELECT id, name FROM ' . $this->tableName() . ' WHERE id = :id LIMIT 1';
        $id = sanitize($id);
        $stmt = $this->dbconn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->id = filter_var($data['id'], FILTER_VALIDATE_INT);
            $this->name = filter_var($data['name'], FILTER_SANITIZE_STRING);

            return get_object_vars($this);
        } else {
            return false;
        }
    }

    public function getStoreName($id) {
        $result = $this->getRecordById($id);
        return $result['name'];
    }

}