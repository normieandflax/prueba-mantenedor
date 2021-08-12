<?php
class Database {
    private $host;
    private $db;
    private $username;
    private $password;

    public function __construct() {
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->username = constant('USERNAME');
        $this->password = constant('PASSWORD');
    }

    function connect() {
        try {
            $connection = "mysql:host=".$this->host.";dbname=".$this->db;
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $pdo = new PDO($connection, $this->username, $this->password, $options);
            
            return $pdo;
        }
        catch(PDOException $ex) {
            print_r('Error connection: '.$ex->getMessage());
        }
    }
}