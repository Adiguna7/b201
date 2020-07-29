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

     public function addUser($data){         
         $query = "INSERT INTO ". $this->table ." VALUES (NULL, :user_name, :user_email, :user_nrp, :user_phone, :user_password, NULL, NULL)";         
         // var_dump($query);         
         $hashpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
         $this->db->query($query);
         // var_dump($data['name']);
         $this->db->bind('user_name', $data['name']);
         $this->db->bind('user_email', $data['email']);
         $this->db->bind('user_nrp', $data['nrp']);
         $this->db->bind('user_phone', $data['phone']);
         $this->db->bind('user_password', $hashpassword);

         $this->db->execute();

         return $this->db->rowCount();
     }

     public function checkVerify($id){
        $query = "SELECT is_verify FROM " . $this->table . " WHERE userId = '$id'";
        $this->db->query($query);
        return $this->db->resultSingle();
     }

     public function checkUsername($username){
        $query = "SELECT user_name FROM " . $this->table . " WHERE user_name = :username";        
        $this->db->query($query);              
        $this->db->bind('username', $username);
        return $this->db->resultSingle();
     }

     public function updateVerify($email){
         $query = "UPDATE " . $this->table . " SET is_verify='1' WHERE user_email = '$email'";
         $this->db->query($query);
         $this->db->execute();
         return $this->db->rowCount();
      }

      public function updatePassword($userid, $newpassword){
         $hashnewpassword = password_hash($newpassword, PASSWORD_BCRYPT);
         $query = "UPDATE " . $this->table . " SET user_password = :userpassword WHERE userId = :userid";
         $this->db->query($query);
         $this->db->bind('userid', $userid);
         $this->db->bind('userpassword', $hashnewpassword);
         $this->db->execute();
         return $this->db->rowCount();
      }
      
      public function getbyUsername($username){
         $query = "SELECT * FROM " . $this->table . " WHERE user_name = :username";
         $this->db->query($query);
         $this->db->bind('username', $username);
         return $this->db->resultSingle();
      }

      public function getbyUseremail($useremail){
         $query = "SELECT * FROM " . $this->table . " WHERE user_email = :useremail LIMIT 1";
         $this->db->query($query);
         $this->db->bind('useremail', $useremail);
         return $this->db->resultSingle();
      }
      public function getbyId($userid){
         $query = "SELECT * FROM " . $this->table . " WHERE userId = :userid LIMIT 1";
         $this->db->query($query);
         $this->db->bind('userid', $userid);
         return $this->db->resultSingle();
      }

      public function updatetoAdmin($userid){         
         $query = "UPDATE " . $this->table . " SET is_admin = 1 WHERE userId = :userid";
         $this->db->query($query);
         $this->db->bind('userid', $userid);         
         $this->db->execute();
         return $this->db->rowCount();
      }

      public function updatetoUser($userid){         
         $query = "UPDATE " . $this->table . " SET is_admin = NULL WHERE userId = :userid";
         $this->db->query($query);
         $this->db->bind('userid', $userid);         
         $this->db->execute();
         return $this->db->rowCount();
      }
 }
?>