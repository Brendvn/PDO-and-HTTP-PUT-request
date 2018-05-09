<?php
//require_once ('Connection.php');
require_once ('Connection.php');
class ModelUser extends Connection  {
    protected $result;
    public $name;
    public $surname;
    public $password;

    public function insert() {
        $this->result = $this->conn->prepare("INSERT INTO userTable(name,surname,password) 
                                VALUES ('{$this->name}','{$this->surname}','{$this->password}')");
        $this->result->execute();
    }
    public function select(){
        //$this->result = $this->conn->query("SELECT * FROM user ORDER BY id DESC LIMIT 1")->fetch();
        $this->result = $this->conn->query("SELECT * FROM userTable ORDER BY id ASC ")->fetchAll(PDO::FETCH_OBJ);
        return $this->result;
    }
}

