
<?php
    class cart {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function insert__cart($product__id, $session__id, $product__img, $product__name, $product__cost, $product__quantity) {
            $query = "INSERT INTO cart (product__id, session__id, product__img, product__name, product__cost, product__quantity) 
            VALUES ('$product__id', '$session__id', '$product__img', '$product__name', '$product__cost', '$product__quantity')";
            $result = $this->db->insert($query);
            echo("<script>window.history.back();</script>");
            return $result;
        }

        public function show__cart($session__id) {
            $query = "SELECT * 
            FROM cart
            WHERE session__id = '$session__id'";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }

        public function update__cart($cart__id, $product__quantity) {
            $query ="UPDATE cart SET product__quantity = $product__quantity WHERE cart__id = '$cart__id'";
            $result = $this->db->update($query);
            echo("<script>location.href = '/PracticeIS207/cart.php';</script>");
            return $result;
        }

        public function delete__cart($cart__id) {
            $query ="DELETE FROM cart WHERE cart__id = '$cart__id'";
            $result = $this->db->delete($query);
            echo("<script>window.history.back();</script>");
            return $result;
        }

        public function count__cart($session__id) {
            $query = "SELECT COUNT(cart__id) as count__cart
            FROM cart
            WHERE session__id = '$session__id'";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }

    }
?>