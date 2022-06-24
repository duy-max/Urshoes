<?php
    $currentPage= basename($_SERVER['PHP_SELF']);
    echo $currentPage;
?>

<section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li <?php if ($currentPage == 'dashboard.php') echo 'class="active"';?>>
                    <a href="./dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-thumbtack"></i> Danh mục</a>
                    <ul>
                        <li><a href="./category__add.php">Thêm danh mục</a></li>
                        <li <?php if ($currentPage == 'category__list.php') echo 'class="active"';?>><a href="category__list.php">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-filter"></i> Loại sản phẩm</a>
                    <ul>
                        <li><a href="producttype__add.php">Thêm loại sản phẩm</a></li>
                        <li <?php if ($currentPage == 'producttype__list.php') echo 'class="active"';?>><a href="producttype__list.php">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-book-open"></i> Sản Phẩm</a>
                    <ul>
                        <li><a href="product__add.php">Thêm sản phẩm</a></li>
                        <li <?php if ($currentPage == 'product__list.php') echo 'class="active"';?>><a href="product__list.php">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="cart__list.php"><i class="fas fa-shopping-cart"></i> Đơn hàng</a>
                    <ul>
                        <li <?php if ($currentPage == 'cart__list.php') echo 'class="active"';?>><a href="cart__list.php">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>