<?php
require_once(__DIR__ . '/../../../lib.php');

/**
 * Client class
 */
class Client {
	public $id;
    public $firstname;
    public $lastname;
    public $middlename;
    public $date_visited;
    public $birthday;
    public $street;
    public $city;
    public $province;
    public $email;
    public $store_id;
    public $storeName;
    private $dbconn;
    private $table = 'clients';

    /**
     * Class constructor
     */
    public function __construct($dbconn) {
        $this->dbconn = $dbconn;
        $this->init();
    }

    /**
     * Set the default values of all properties
     */
    public function init() {
        $this->id = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->middlename = null;
        $this->date_visited = null;
        $this->birthday = null;
        $this->street = null;
        $this->city = null;
        $this->province = null;
        $this->email = null;
        $this->store_id = null;
        $this->storeName = null;
    }

    /**
     * Insert record
     * 
     * @return boolean
     */
    public function create() {

        $sql = 'INSERT INTO ' . $this->table . ' SET '
             . 'firstname = :firstname, lastname = :lastname, middlename = :middlename, date_visited = :date_visited, birthday = :birthday, street = :street, city = :city, province = :province, email = :email, store_id = :store_id';

        $stmt = $this->dbconn->prepare($sql);

        // sanitize input data
        $this->sanitizeData();

        // bind parameters
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':middlename', $this->middlename);
        $stmt->bindParam(':date_visited', $this->date_visited);
        $stmt->bindParam(':birthday', $this->birthday);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':province', $this->province);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':store_id', $this->store_id);

        if($stmt->execute()) {
            // --TODO: return the inserted id
            return true;
        }
        return false;
    }

    /**
     * Update record
     * 
     * @return boolean
     */
    public function update() {
        $sql = 'UPDATE ' . $this->table . ' SET '
             . 'firstname = :firstname, lastname = :lastname, middlename = :middlename, date_visited = :date_visited, birthday = :birthday, street = :street, city = :city, province = :province, email = :email, store_id = :store_id '
             . 'WHERE id = :id';

        $stmt = $this->dbconn->prepare($sql);

        // sanitize input data
        $this->sanitizeData();

        // bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':middlename', $this->middlename);
        $stmt->bindParam(':date_visited', $this->date_visited);
        $stmt->bindParam(':birthday', $this->birthday);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':province', $this->province);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':store_id', $this->store_id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    /**
     * Delete record
     * 
     * @param int $id optional
     * @return boolean
     */
    public function delete($id = null) {
        if(!$id) {
            $id = htmlspecialchars(strip_tags($this->id));
        }

        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->dbconn->prepare($sql);
        // bind parameters
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Get all records matching given criterias
     * 
     * @param array $where_args search conditions represented by key-value pairs
     * @param string $fields custom fields to fetch
     * @param string $order order by SQL
     * @param int $limit how many records to get
     * @param int $offset where in the records to start
     * @return array
     */
    public function getRecords($where_args = [], $fields = '', $order = '', $limit = null, $offset = null) {
        
        if(!$fields) { $fields = $this->getSelectFields(); }

        $fields = preg_replace('/[ ]+/', ' ', $fields);
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table;

        if($where_args) {
            list($where, $params) = $this->getWhereSql($where_args);
            $sql .= " WHERE $where";
        }
        // order by
        if($order) { $sql .= " ORDER BY $order "; }
        // offset and limit
        if($offset && $limit) {
            $sql .= " LIMIT $offset, $limit ";
        } elseif($limit) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->dbconn->prepare($sql);

        // bind parameters
        foreach($params as $field => $value) {
            $stmt->bindParam($field, $value);
        }

        if($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($data as &$item) {
                $item['id'] = intval($item['id']);
                $item['store_id'] = intval($item['store_id']);
            }
            return $data;
        }
        else {
            return [];
        }
    }

    /**
     * Get a single record matching given criteria
     * 
     * @param array $where search conditions represented by key-value pairs
     * @param string $fields custom fields to fetch
     * @return boolean
     */
    public function getRecord($where = [], $fields = '') {
        if(!$fields) {
            $fields = $this->getSelectFields();
        }
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table;

        if($where) {
            list($where_sql, $params) = $this->getWhereSql($where);
            $sql .= " WHERE $where_sql";
        }
        
        $sql .= ' LIMIT 1';
        $stmt = $this->dbconn->prepare($sql);

        // bind parameters
        foreach($params as $field => $value) {
            $stmt->bindParam($field, $value);
        }

        if($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->init();
            $this->id = intval($row['id']);
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->middlename = $row['middlename'];
            $this->date_visited = $row['date_visited'];
            $this->birthday = $row['birthday'];
            $this->street = $row['street'];
            $this->city = $row['city'];
            $this->province = $row['province'];
            $this->email = $row['email'];
            $this->store_id = intval($row['store_id']);

            return true;
        }
        return false;
    }

    /**
     * Fetch a single record by the record ID
     * 
     * @param int $id
     * @return boolean
     */
    public function getRecordById($id) {
        $fields = $this->getSelectFields();
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' WHERE id = :id LIMIT 1';
        $stmt = $this->dbconn->prepare($sql);
        // bind parameters
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->init();
            $this->id = intval($row['id']);
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->middlename = $row['middlename'];
            $this->date_visited = $row['date_visited'];
            $this->birthday = $row['birthday'];
            $this->street = $row['street'];
            $this->city = $row['city'];
            $this->province = $row['province'];
            $this->email = $row['email'];
            $this->store_id = intval($row['store_id']);

            return true;
        }
        return false;
    }

    /**
     * Return the default column list for the SQL statement
     * 
     * @return string
     */
    public function getSelectFields() {
        return 'id, firstname, middlename, lastname, date_visited, birthday, street, city, province, email, store_id';
    }

    /**
     * Build the where conditions and parameters
     * 
     * @param array key-value pairs
     * @return array [string, array]
     */
    public function getWhereSql($args) {
        $cond = [];
        $params = [];

        foreach($args as $field => $value) {
            $cond[] = "$field = :$field";
            $params[":$field"] = $value; 
        }
        $cond_string = implode(' AND ', $cond);
        return [$cond_string, $params];
    }

    /**
     * Sanitize the data
     */
    public function sanitizeData() {
        $this->firstname = sanitize($this->firstname);
        $this->lastname = sanitize($this->lastname);
        $this->middlename = sanitize($this->middlename);
        $this->date_visited = sanitize($this->date_visited);
        $this->birthday = sanitize($this->birthday);
        $this->street = sanitize($this->street);
        $this->city = sanitize($this->city);
        $this->province = sanitize($this->city);
        $this->email = sanitize($this->email);
        $this->store_id = sanitize($this->store_id);
    }

}