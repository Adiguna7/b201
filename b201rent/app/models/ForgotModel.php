<?php

    class ForgotModel{
        private $table = 'forgot_pass';
        private $db;

        public function __construct(){
            $this->db = new Database;   
        }

        public function insert($userid, $remembertoken){
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :userid, :remembertoken)";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            $this->db->bind("remembertoken", $remembertoken);            
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function update($userid, $remembertoken){
            $query = "UPDATE " . $this->table . " SET remember_token = :remembertoken WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            $this->db->bind("remembertoken", $remembertoken);            
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function selectbyId($userid){
            $query = "SELECT * FROM " . $this->table . " WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind("userid", $userid);            
            return $this->db->resultSingle();
        }

        public function selectbyToken($remembertoken){
            $query = "SELECT * FROM " . $this->table . " WHERE remember_token = :remembertoken";
            $this->db->query($query);
            $this->db->bind("remembertoken", $remembertoken);            
            return $this->db->resultSingle();
        }

        public function deletebyId($userid){
            $query = "DELETE FROM " . $this->table . " WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind('userid', $userid);
            return $this->db->resultSingle();
         }

    }

?>