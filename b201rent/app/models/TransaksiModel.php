<?php

    class TransaksiModel{
        private $table = 'transaksi';
        private $db;

        public function __construct()
        {
            $this->db = new Database;   
        }

        public function getStatus($userid){
            $query = "SELECT transaksi_status FROM " . $this->table . " WHERE userId = $userid";
            // $this->db->bind("userid", $userid);
            // $this->db->bind("itemid", $itemid);
            $this->db->query($query);
            return $this->db->resultSingle();
        }

        public function addData($userid, $itemid, $maxrent){
            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :itemid, :userid, :transaksistart, :transaksiend, 'waiting')";
            $datenow = date('Y-m-d');
            $dateend = date('Y-m-d', strtotime($datenow . ' + '. $maxrent .' days'));
            $this->db->query($query);
            $this->db->bind("itemid", $itemid);
            $this->db->bind("userid", $userid);
            $this->db->bind("transaksistart", $datenow);
            $this->db->bind("transaksiend", $dateend);

            $this->db->execute();

            return $this->db->rowCount();            
        }

        public function updateStatus($transaksiid, $status){
            $query = "UPDATE " . $this->table . " SET transaksi_status = '$status' WHERE transaksi_id = '$transaksiid'";
            $this->db->query($query);
            $this->db->execute();
            return $this->db->rowCount();            
        }

        // ROW GABUNGAN
        public function getByUseridHistory($userid){
            $query = "SELECT i.item_name, i.item_image, i.item_charge, t.transaksi_start, t.transaksi_end, t.transaksi_status FROM items i, transaksi t WHERE t.userId = :userid AND i.item_id = t.item_id;";
            $this->db->query($query);
            $this->db->bind("userid", $userid);            
            return $this->db->resultSet();
        }

        public function getAllHistory(){
            $query = "SELECT t.transaksi_id, i.item_id, u.user_name, i.item_name, i.item_category, t.transaksi_start, t.transaksi_end, t.transaksi_status FROM items i, transaksi t, users u WHERE u.userId = t.userId AND i.item_id = t.item_id";
            $this->db->query($query);
            return $this->db->resultSet();            
        }

        public function getTimeEndSingle($userid){
            $query = "SELECT i.item_charge, t.transaksi_end FROM transaksi t, items i WHERE userId = '$userid' AND transaksi_status <> 'done' AND i.item_id = t.item_id" ;
            $this->db->query($query);
            return $this->db->resultSingle();            
        }
    }

?>