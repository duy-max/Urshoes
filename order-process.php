<?php
    if (isset($_GET['madh'])) {
        $madh = $_GET['madh'];
    }
    else header("Location: ./index.php");
    $css = 'order-process.css';
    include "header.php";
?>

<div class="order-success">
    <div class="icon-success">
        <i class="fas fa-check"></i>
    </div>
    <h1> Đặt hàng thành công</h1>
    <p class="message-thankyou">Cảm ơn bạn đã quan tâm và mua hàng </p>
    <p class="message-check">Bạn có thể theo dõi thông tin đơn hàng bằng mã: <?=$madh?></p>
    <a class="btn-continue" href="./index.php">Tiếp tục mua sắm</a>
</div>