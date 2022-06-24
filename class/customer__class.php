<?php
    class customer {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function insert__customer($customer__name, $customer__email, $customer__phone, $customer__province, $customer__district, $customer__ward, $customer__address, $customer__pass) {
            $check__email = "SELECT * FROM customer WHERE customer__email = '$customer__email'";
            $result = $this->db->select($check__email);
            if ($result) {
                $alert = "<p style='text-align: center;'> Email da ton tai </p>";
                return $alert;
            }
            else {
                $query = "INSERT INTO customer (customer__name, customer__email, customer__phone, customer__province, customer__district, customer__ward, customer__address, customer__pass)
                VALUES ('$customer__name', '$customer__email', '$customer__phone', '$customer__province', '$customer__district', '$customer__ward', '$customer__address', '$customer__pass')";
                $this->db->insert($query);
                $result2 = $this->db->select("SELECT customer__id FROM customer WHERE customer__email = '$customer__email'")->fetch_assoc();
                Session::set('customer__login', true);
                Session::set('customer__id', $result2['customer__id']);
                Session::set('customer__email', $customer__email);
                echo("<script>location.href = './index.php';</script>");
            }
        }

        public function login__customer($customer__email, $customer__pass, $remember) {
            $check__email = "SELECT * FROM customer WHERE customer__email = '$customer__email' AND customer__pass = md5('$customer__pass')";
            $result__check = $this->db->select($check__email);
            if ($result__check) {
                $result = $result__check->fetch_assoc();
                Session::set('customer__login', true);
                Session::set('customer__id', $result['customer__id']);
                Session::set('customer__email', $result['customer__email']);
                if ($remember) {
                    setcookie("customer__email", $customer__email, time() + 30*86400, "/");
                    setcookie("customer__pass", $customer__pass, time() + 30*86400, "/");
                } else {
                    setcookie("customer__email", '', -1, "/");
                    setcookie("customer__pass", '', -1, "/");
                }
                echo("<script>location.href = './index.php';</script>");
            }
        }
    }
?>