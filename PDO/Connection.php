<?php
require_once ('ModelInterface.php');
abstract class Connection implements ModelInterface {

    protected $host = "localhost";
    protected $dbname = "pdotest";
    protected $user = "root";
    protected $pass = "root";
    protected $conn;

    function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                    $this->user,
                    $this->pass,
                    [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]
            );
        }
        catch (PDOException $e) {
            echo $e->getMessage(),PHP_EOL;
        }
    }
    public function closeConnection() {
        $this->conn = null;
    }
}
