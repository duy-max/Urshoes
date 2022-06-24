<?php 
    include_once "database/database.php";
    include "session/session.php";
    include "class/category__class.php";
    include "class/producttype__class.php";
    include "class/product__class.php";
    include "class/customer__class.php";
    include "class/comment__class.php";
    include "class/cart__class.php";

    Session::init();
    ob_start();
    $category = new category;
    $producttype = new productType;
    $product = new product;
    $customer = new customer;
    $comment = new comment;
    $cart = new cart;
?>

<?php 
    $producttype = new producttype;
    $show__category = $producttype->show__category();

    // $show__cart = $cart->show__cart(Session_id());
    // $count__cart = $cart->count__cart(Session_id());
    $cart = [];
    if (isset($_SESSION['cart']))
        $cart = $_SESSION['cart'];
    $count = count($cart);

    
    // if (isset($_GET['cart__id']) && isset($_GET['q']) && $_GET['q'] == 'delete') {
    //     $cart->delete__cart($_GET['cart__id']);
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/<?php if (!empty($css)) echo $css?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Shop bán giày</title>
</head>
<body>
    <div id="main">
        <!---------------------------------------- Header ---------------------------------------->
        <header id="main-header">
            <div class="grid wide">
                <div class="header" id="header">
                    <a href="./index.php" class="logo-on-tablet hide-on-pc hide-on-mobile">
                        <img src="./assets/img/logo.png" alt="">
                    </a>
                    <nav class="header-nav">
                        <ul>
                            <li class="logo">
                                <a href="./index.php">
                                    <img src="./assets/img/logo.png" alt="">
                                </a>
                            </li>
    
                            <li class="menu">
                                <div class="menu__mobile" id="menu__mobile">
                                    <p class="menu__mobile-click hide-on-pc hide-on-tablet">
                                        <i class="fas fa-bars"></i>
                                        Danh mục
                                    </p>
                                    
                                    <ul class="menu-list">
                                        <div class="login__mobile hide-on-tablet hide-on-pc">
                                            <a href="./signin.php">
                                                Đăng nhập
                                                <i class="fas fa-user-circle"></i>
                                            </a>
                                        </div>
                                        
                                        <?php 
                                            while($resultC = $show__category->fetch_assoc()) {
                                                $show__producttype = $producttype->show__producttype_by_categoryid($resultC['category__id']);
                                        ?>
                                            <li class="menu-list__products">
                                                <a href="<?php 
                                                    $get_producttype = $producttype->get__producttype_first($resultC['category__id'])->fetch_assoc();
                                                    if ($get_producttype['producttype__id']) {
                                                        echo "./products.php?category__id=";
                                                        echo $resultC['category__id'];
                                                        echo "&producttype__id=";
                                                        echo $get_producttype['producttype__id'];
                                                    }
                                                    else {
                                                        echo "#";
                                                    }
                                                ?>">
                                                    <span><?php echo $resultC['category__name']?></span>
                                                    <?php
                                                        if ($show__producttype) {
                                                            echo '<i class="fas fa-angle-down"></i>';
                                                        } 
                                                    ?>
                                                </a>
                                                <ul class="subMenu-list">
                                                    <?php 
                                                        if ($show__producttype) {
                                                            while ($resultPT = $show__producttype->fetch_assoc()) {
                                                    ?>
                                                                <li><a href="./products.php?category__id=<?php 
                                                                            echo $resultC['category__id'];
                                                                            echo "&producttype__id=";
                                                                            echo $resultPT['producttype__id'];
                                                                    ?>">
                                                                    <?php 
                                                                        if ($resultC) 
                                                                            {echo $resultPT['producttype__name'];}
                                                                    ?>
                                                                </a></li>
                                                    <?php 
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </li>

                            <li class="others">
                                <ul class="others-list">
                                    <li class="hide-on-mobile">
                                        <form method="get" action="./lookup.php" class="header-search">
                                            <input name="q" type="text" placeholder="Tìm kiếm sản phẩm" title="Tìm kiếm"> 
                                            <button type="submit" title="Tìm kiếm">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="./order_find.php">
                                            <i class="fas fa-paw" title="Tra cứu đơn hàng"></i>
                                        </a>
                                    </li>
                                    
                                    <li class="hide-on-mobile">
                                        <?php 
                                            $login__check = Session::get('customer__login');
                                            $login__id = Session::get('customer__id');
                                            if(!$login__check) {
                                                echo "<a href='./signin.php'>
                                                        <i class='fas fa-user' title='Đăng nhập'></i>
                                                     </a>";
                                            } else {
                                                echo "
                                                    <a href='./logout.php'>
                                                        <i class='fas fa-sign-out-alt' title='Đăng xuất'></i>
                                                    </a>
                                                ";
                                            }
                                        ?>
                                        
                                    </li>
                                    <li class="search-cart--wrap">
                                        <a href="./cart.php">
                                            <i class="fa fa-shopping-bag"></i>
                                        </a>
                                        <?php
                                            // $count = $count__cart->fetch_assoc();
                                            if ($count > 0) {
                                                echo "
                                                    <span>". $count ."</span>
                                                ";
                                            } 
                                        
                                        ?>
                                        <div class="cart__list hide-on-mobile">
                                            <?php
                                                if ($cart) {
                                                    echo '<p class="cart__list-header">Sản Phẩm Mới Thêm</p>';
                                                    echo '<ul class="cart__list-list">';
                                                    foreach($cart as $item) {
                                            ?>
                                            <!-- <img class="no-cart" src="./assets/img/no_cart.png" alt="">
                                            <span class="cart__list--empty">Chưa Có Sản Phẩm</span> -->
                                                <li class="cart__list-item">
                                                    <img class="cart__list-item-img" src="./admin/uploads/<?php echo $item['product__img']?>" alt="">
                                                    
                                                    <div class="cart__list-item-description">
                                                        <div class="cart__list-item-heading">
                                                            <h4 class="cart__list-item-name"><?php echo $item['product__name'] ?></h4>
                                                            
                                                            <div class="cart__list-item-detail">
                                                                <span class="cart__list-item-cost highlight"><?php echo $item['product__cost'] ?></span>
                                                                <span class="cart__list-item-multiply">x</span>
                                                                <span class="cart__list-item-quanlity"><?php echo $item['quantity'] ?></span>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="cart__list-item-body">
                                                            <div class="cart__list-item-type">
                                                                <!-- <span class="cart__list-item-color">Màu: xanh</span>
                                                                <span class="cart__list-item-size">Size: 43</span> -->
                                                            </div>
                                                            <!-- <a class="cart__list-item-remove" href="?q=delete&cart__id=<?php //echo $item['cart__id']?>" title="Xóa">Xóa</a> -->
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php 
                                                    }
                                                    echo '</ul>';
                                                }
                                            ?>
                                                
                                            <?php 
                                                if($cart) {
                                                    echo '
                                                    <div class="cart__list-footer">
                                                    <a href="./cart.php" class="btn-submit ">Xem Giỏ Hàng</a>
                                                </div>
                                                    ';
                                                }
                                            ?>
                                            
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>