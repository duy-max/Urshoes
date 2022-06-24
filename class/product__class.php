
<?php
    class product {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function show__category() {
            $query = "SELECT * FROM category ORDER BY category__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function show__producttype() {
            $query = "SELECT producttype__id, category__name, producttype__name 
            FROM producttype INNER JOIN category ON producttype.category__id = category.category__id 
            ORDER BY producttype__id";
            $result = $this->db->select($query);
            return $result;
        }

        public function show__producttype_ajax($category__id) {
            $query = "SELECT * FROM producttype WHERE category__id = '$category__id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert__product($category__id, $producttype__id, $product__name, $product__cost, $product__img, $product__img2, $product__img3, $product__img4) {
            $query = "INSERT INTO product (category__id, producttype__id, product__name, product__cost, product__img, product__img2, product__img3, product__img4) 
            VALUES ('$category__id', '$producttype__id', '$product__name', '$product__cost', '$product__img', '$product__img2', '$product__img3', '$product__img4')";
            $result = $this->db->insert($query);
            // header('Location:producttype__list.php');
            return $result;
        }

        public function show__product() {
            $query = "SELECT product__id, category.category__name, producttype.producttype__name, product__name, product__cost, product__img 
            FROM category, producttype, product
            WHERE category.category__id = product.category__id AND producttype.producttype__id = product.producttype__id";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }

        public function show__product_by_categoryid_producttypeid($category__id, $producttype__id) {
            $query = "SELECT product__id, product__name, product__cost, product__img 
            FROM product
            WHERE category__id = $category__id AND producttype__id = $producttype__id
            ORDER BY product__cost";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }

        public function show__product_by_categoryid_producttypeid_desc_limit_6($category__id, $producttype__id,$start) {
            $query = "SELECT product__id, product__name, product__cost, product__img 
            FROM product
            WHERE category__id = $category__id AND producttype__id = $producttype__id ORDER BY product__cost desc limit $start, 6
            ";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }
      
        public function show__product_by_categoryid_producttypeid_limit_6($category__id, $producttype__id,$start) {
            $query = "SELECT product__id, product__name, product__cost, product__img 
            FROM product
            WHERE category__id = $category__id AND producttype__id = $producttype__id ORDER BY product__cost limit $start, 6
            ";
            $result = $this->db->select($query);
            // header('Location:producttype__list.php');
            return $result;
        }

        public function get__product($product__id) {
            $query = "SELECT * FROM product WHERE product__id = '$product__id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update__product($product__id, $category__id, $producttype__id, $product__name, $product__cost, $product__img) {
            $query = "UPDATE product SET 
            category__id = '$category__id',
            producttype__id = '$producttype__id', 
            product__name = '$product__name', 
            product__cost = '$product__cost',
            product__img = '$product__img',
            product__img2 = '$product__img2',
            product__img3 = '$product__img3',
            product__img4 = '$product__img4' 
            WHERE product__id = '$product__id'";
            $result = $this->db->update($query);
            header('Location:product__list.php');
            return $result;
        }

        public function delete__product($product__id) {
            $query = "DELETE FROM product WHERE product__id = '$product__id'";
            $result = $this->db->delete($query);
            header('Location:product__list.php');
            return $result;
        }

        public function lookup__product($keyword) {
            $query = "SELECT * FROM product WHERE product__name LIKE '%$keyword%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function lookup__product__category__id($keyword, $category__id) {
            $query = "SELECT * FROM product WHERE product__name LIKE '%$keyword%' AND category__id = '$category__id'";
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