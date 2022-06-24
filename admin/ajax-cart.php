<?php
    
    include_once "../database/database.php";

     if (!empty($_POST['id']) || !empty($_GET['id']) ) {
        if (!empty($_POST['action']) )
            $action = $_POST['action'];
        else $action = $_GET['action'];
       
        switch ($action) {
            case 'updateStatus':
                $id = $_POST['id'];
                $status = $_POST['status'];
                updateStatus($id, $status);
                break;
            case 'showCartDetail':
                $id = $_GET['id'];
                showCartDetail($id);
                break;
        }
    }

    function updateStatus($id, $status) {
        $db = new Database;
        $sql = "update cart set status = '".$status."' where id = '".$id."'";
        if ($db->update($sql)) {
            echo true;
        }
        else echo false;
    }

    function showCartDetail($id) {
        $db = new Database;
        $sql = "select cart_detail.*, product.product__name as product_name from cart_detail, product where cart_id = '".$id."' and product.product__id = product_id";
        $result = $db->select($sql);
        $output = array();
        if (($result)) {
            while($row = $result->fetch_array()) {
                $output[] = array(
                    'MASP' => $row['product_id'],
                    'TENSP' => $row['product_name'],
                    'SL' => $row['quantity'],
                    'PRICE' => $row['price'],
                );
            }
            echo json_encode($output);
        }
        else echo false;
    }
?>