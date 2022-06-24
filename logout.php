<?php 
    session_start();
    if (isset($_SESSION['customer__id'])) {
        echo "OK";
        unset($_SESSION['customer__login']);
        unset($_SESSION['customer__id']);
        unset($_SESSION['customer__email']);
    }
    header("Location: ./index.php");
?>