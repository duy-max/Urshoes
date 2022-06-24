<?php
    class category {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function insert__category($category__name) {
            $query = "INSERT INTO category (category__name) VALUES ('$category__name')";
            $result = $this->db->insert($query);
            header('Location:category__list.php');
            return $result;
        }

        public function show__category() {
            $query = "SELECT * FROM category ORDER BY category__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function get__category($category__id) {
            $query = "SELECT * FROM category WHERE category__id = '$category__id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update__category($category__id, $category__name) {
            $query = "UPDATE category SET category__name = '$category__name' WHERE category__id = '$category__id'";
            $result = $this->db->update($query);
            header('Location:category__list.php');
            return $result;
        }

        public function delete__category($category__id) {
            $query = "DELETE FROM category WHERE category__id = '$category__id'";
            $result = $this->db->delete($query);
            header('Location:category__list.php');
            return $result;
        }
    }
?>