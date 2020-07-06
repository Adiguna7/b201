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

        public function getById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE item_id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            return $this->db->resultSingle();

        }

        public function getCount($category = null){
            if ($category == NULL) {
                $query = "SELECT COUNT(*) AS jumlah FROM " . $this->table;
                $this->db->query($query);
                return $this->db->resultSingle();
            }
            else{
                $query = "SELECT COUNT(*) AS jumlah FROM " . $this->table . " WHERE item_category = '$category'";
                $this->db->query($query);
                return $this->db->resultSingle();
            }
        }

        public function getFromCategory($category){
            $query = "SELECT * FROM " . $this->table . " WHERE item_category = '$category'";
            $this->db->query($query);
            return $this->db->resultSet();
        }

        public function getFromCategoryLimit($category, $limit){
            $query = "SELECT * FROM " . $this->table . " WHERE item_category = :category ORDER BY RAND() LIMIT :limit";
            $this->db->query($query);
            $this->db->bind("category", $category);
            $this->db->bind("limit", $limit);
            return $this->db->resultSet();
        }
        
        public function getEndId(){
            $query = "SELECT item_id FROM " . $this->table . " ORDER BY item_id DESC LIMIT 1";
            $this->db->query($query);
            return $this->db->resultSingle();
        }
        
        public function addOne($data, $itemimage){
            $item_name = $data['itemname'];
            $item_description = $data['itemdescription'];
            $item_category = $data['itemcategory'];
            $item_stock = $data['itemstock'];
            $item_maxrent = $data['itemmaxrent'];
            $item_charge = $data['itemcharge'];

            $query = "INSERT INTO " . $this->table . " VALUES (NULL, :item_name, :item_image, :item_description, :item_category, :item_stock, :item_maxrent, :item_charge)";
            $this->db->query($query);
            $this->db->bind('item_name', $item_name);
            $this->db->bind('item_image', $itemimage);
            $this->db->bind('item_description', $item_description);
            $this->db->bind('item_category', $item_category);
            $this->db->bind('item_stock', $item_stock);
            $this->db->bind('item_maxrent', $item_maxrent);
            $this->db->bind('item_charge', $item_charge);

            $this->db->execute();

            return $this->db->rowCount();
        }
        public function updateOne($data){
            $item_id = $data['itemid'];
            $item_name = $data['itemname'];
            $item_description = $data['itemdescription'];
            $item_category = $data['itemcategory'];
            $item_stock = $data['itemstock'];
            $item_maxrent = $data['itemmaxrent'];
            $item_charge = $data['itemcharge'];
            $query = "UPDATE " . $this->table .
                    " SET item_name = '$item_name',
                    item_description = '$item_description',
                    item_category = '$item_category',
                    item_stock = '$item_stock',
                    item_maxrent = '$item_maxrent',
                    item_charge = '$item_charge'
                    WHERE item_id = '$item_id'
                    ";
            $this->db->query($query);
            $this->db->execute();
            return $this->db->rowCount();
        }
        public function deleteOne($id){
            $query = "DELETE FROM " . $this->table . " WHERE item_id = '$id'";
            $this->db->query($query);
            $this->db->execute();
            return $this->db->rowCount();
        }        

    }
?>