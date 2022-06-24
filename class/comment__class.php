<?php
    class comment {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function insert__comment($customer__id, $product__id, $comment__content) {
            $query = "INSERT INTO comment (customer__id, product__id, comment__content) VALUES ($customer__id, $product__id, '$comment__content')";
            $result = $this->db->insert($query);
            echo("<script>window.history.back();</script>");
            return $result;
        }

        public function show__comment($product__id) {
            $query = "SELECT * FROM comment, customer WHERE customer.customer__id = comment.customer__id AND comment.product__id = '$product__id' ORDER BY comment__id DESC";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>