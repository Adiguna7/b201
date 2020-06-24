 <?php
 
 class UsersModel{
     private $table = 'users';
     private $db;

     public function __construct()
     {
        $this->db = new Database;   
     }
     
     public function getAll(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
     }
 }
 
 ?>