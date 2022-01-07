<?php
/**
 * Client class
 */
class Client {
	public $id;
    public $firstname;
    public $lastname;
    public $middlename;
    public $datevisited;
    public $birthday;
    public $street;
    public $city;
    public $province;
    public $email;
    public $store_id;
    public $storesVisited;
    private $dbconn;
    private $table = 'clients';

    public function __construct($dbconn) {
        $this->dbconn = $dbconn;
    }

    public function create() {
        //
    }

    public function update() {
        //
    }
    
    public function delete() {
        //
    }

    public function getRecords($where_args = [], $fields = '', $order = '', $limit = null, $offset = null) {
        
        if(!$fields) { $fields = $this->getSelectFields(); }
        
        $sql = 'SELECT ' . $fields . ' FROM ' . $this->table . ' AS c';

        if($where_args) {
            list($where, $params) = $this->getWhereSql($where_args);
            $sql .= " WHERE $where";
        }
        
        if($order) { $sql .= " ORDER BY $order "; }

        if($offest && $limit) {
            $sql .= " LIMIT $offset, $limit ";
        } elseif($limit) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->dbconn->prepare($sql, $params);
        $stmt->execute();

        return $stmt;
    }

    public function getRecord($where = [], $fields = '') {
        //
    }

    public function getSelectFields() {
        return 'c.id, c.firstname, c.middlename, c.lastname, c.datevisited, c.birthday, c.street, c.city, c.province, c.email';
    }

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

}