<?php

    class FailedModel{
        private $table = 'failed_jobs';
        private $db;

        public function __construct(){
            $this->db = new Database;   
        }

        public function getOneUser($userid){
            $query = "SELECT * FROM " . $this->table . " WHERE userId = :userid LIMIT 1";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            return $this->db->resultSingle();
        }

        public function getCheckOneUser($userid, $timenow){
            $query = "SELECT * FROM " . $this->table . " WHERE userId = :userid AND start_time < :timenow AND :timenow2 < end_time";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            $this->db->bind("timenow", $timenow);
            $this->db->bind("timenow2", $timenow);
            return $this->db->resultSingle();
        }
        
        public function updatebyAttempt($userid, $attempt){
            $query = "UPDATE " . $this->table . " SET attempt = :attempt WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            $this->db->bind("attempt", $attempt);
            $this->db->execute();
            return $this->db->rowCount();
        }
        public function updatebyTime($userid, $starttime, $endtime){
            $query = "UPDATE " . $this->table . " SET start_time = :starttime, end_time = :endtime WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind("userid", $userid);
            $this->db->bind("starttime", $starttime);
            $this->db->bind("endtime", $endtime);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function insertbyUserid($userid){
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :userid, 1, NULL, NULL, NULL)";
            $this->db->query($query);
            $this->db->bind("userid", $userid);            
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function deletebyId($userid){
            $query = "DELETE FROM " . $this->table . " WHERE userId = :userid";
            $this->db->query($query);
            $this->db->bind('userid', $userid);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }
?>