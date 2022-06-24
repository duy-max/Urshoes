
<?php
    class producttype {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function insert__producttype($category__id, $producttype__name) {
            $query = "INSERT INTO producttype (category__id, producttype__name) VALUES ('$category__id', '$producttype__name')";
            $result = $this->db->insert($query);
            header('Location:producttype__list.php');
            return $result;
        }

        public function show__category() {
            $query = "SELECT * FROM category ORDER BY category__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function show__producttype() {
            $query = "SELECT producttype__id, producttype.category__id, category__name, producttype__name 
            FROM producttype INNER JOIN category ON producttype.category__id = category.category__id 
            ORDER BY producttype__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function show__producttype1() {
            $query = "SELECT DISTINCT category.category__id, category__name
            FROM producttype INNER JOIN category ON producttype.category__id = category.category__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function get__producttype_first($category__id) {
            $query = "SELECT MIN(producttype__id) as producttype__id FROM producttype WHERE category__id = '$category__id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function show__producttype_by_categoryid($category__id) {
            $query = "SELECT producttype__id, category.category__id, category__name, producttype__name 
            FROM producttype, category  
            WHERE producttype.category__id = $category__id AND producttype.category__id = category.category__id
            ORDER BY producttype__id
            ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get__producttype($producttype__id) {
            $query = "SELECT * FROM producttype WHERE producttype__id = '$producttype__id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update__producttype($producttype__id, $category__id, $producttype__name) {
            $query = "UPDATE producttype SET producttype__name = '$producttype__name', category__id = '$category__id' WHERE producttype__id = '$producttype__id'";
            $result = $this->db->update($query);
            header('Location:producttype__list.php');
            return $result;
        }

        public function delete__producttype($producttype__id) {
            $query = "DELETE FROM producttype WHERE producttype__id = '$producttype__id'";
            $result = $this->db->delete($query);
            header('Location:producttype__list.php');
            return $result;
        }

    }
?>