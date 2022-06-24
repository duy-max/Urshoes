<?php
    class admin {
        private $db;
        
        public function __construct() {
            $this->db = new Database;
        }

        public function login__admin($admin__user, $admin__pass) {
            $check__user = "SELECT * FROM admin WHERE admin__user = '$admin__user' AND admin__pass = '$admin__pass'";
            $result__check = $this->db->select($check__user);
            if ($result__check) {
                $result = $result__check->fetch_assoc();
                Session::set('admin__login', true);
                
                Session::set('admin__id', $result['admin__id']);
                Session::set('admin__user', $result['admin__user']);
                echo("<script>location.href = './index.php';</script>");
            }
        }
    }
?>