<?php
    class ItemsModel{
        private $table = 'items';
        private $db;

        public function __construct()
        {
            $this->db = new Database;   
        }
        public function getAll(){
            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->resultSet();
        }
        public function updateOne($id){
            // $query = "UPDATE ".$this->table.""
        }
        public function deleteOne($id){
            $query = "DELETE FROM " . $this->table . " WHERE item_id = '$id'";
            $this->db->query($query);
            $this->db->execute();
            return $this->db->rowCount();
        }

    }
?>