<?php
    include "./database/database.php";
    include "./session/session.php";
    include "./class/product__class.php";
   
    Session::init();

    if (!empty($_POST['id']) ) {
        $action = $_POST['action'];
        $id = $_POST['id'];
        if (isset($_POST['quantity']))
            $quantity =  $_POST['quantity'];
        
        switch ($action) {
            case 'add':
                addToCart($id, $quantity);
                break;
            case 'delete':
                deleteItem($id);
                break;
            case 'update':
                updateQuantity($id, $quantity);
                break;
        }
       
    }

    function addToCart($id, $quantity) {
        $product = new product;
        $cart = [];
        if (isset($_SESSION['cart']))
            $cart = $_SESSION['cart'];
        // $cart = Session::get('cart');
        $isFind = false;
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['product__id'] == $id) {
                $isFind = true;
                $cart[$i]['quantity'] += $quantity;
                break;
            }
        }
        if (!$isFind) {
            $result = $product->get__product($id);
            $result_product = $result->fetch_assoc();
            $result_product['quantity'] = $quantity;
            $cart[] =  $result_product;
            // $result_product 
        }
        Session::set('cart', $cart);
        echo "OK";
    }

    function deleteItem($id) {
        $product = new product;
        $cart = [];
        if (isset($_SESSION['cart']))
            $cart = $_SESSION['cart'];

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['product__id'] == $id) {
                array_splice($cart, $i, 1);
                break;
            }
        }
        
        Session::set('cart', $cart);
        echo "OK";
    }

    function updateQuantity($id, $quantity) {
        $product = new product;
        $cart = [];
        if (isset($_SESSION['cart']))
            $cart = $_SESSION['cart'];

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['product__id'] == $id) {
                $cart[$i]['quantity'] = $quantity;
                break;
            }
        }
        
        Session::set('cart', $cart);
        echo "OK";
    }
?>