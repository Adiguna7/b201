<?php

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;
    private $db_port = DB_PORT;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        
        $dsn = 'mysql:host='. $this->host . ';port=' . $this->db_port . ';dbname=' . $this->db_name;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = NULL){
        if(is_null($type)){
            switch(true){
                case is_string($value):
                    $type = PDO::PARAM_STR;
                break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        $this->stmt->execute();        
    }

    public function resultSet(){
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }

    public function resultSingle(){
        $this->stmt->execute();
        return $this->stmt->fetch();
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }
}


?>