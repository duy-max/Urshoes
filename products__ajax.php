<?php include 'header.php'; ?>
<div class="row">
<?php
    $sort = $_GET['sort'];
    $start = $_GET['start'];
    $category__id = $_GET['category__id'];
    $producttype__id = $_GET['producttype__id'];
    if ($sort == 'lowtohigh') {
        $show__product = $product->show__product_by_categoryid_producttypeid_limit_6($category__id, $producttype__id,$start);
    } else {
        $show__product = $product->show__product_by_categoryid_producttypeid_desc_limit_6($category__id, $producttype__id,$start);
    }

    if ($resultP = $show__product || $keyword__product) {
        while ($resultP = $show__product->fetch_assoc()) {
?>
    <div class="col l-4 m-4 c-6">
        <a href="./productdetail.php?product__id=<?php echo $resultP['product__id'] ?>"
            class="product">
            <img class="product-image" src="./admin/uploads/<?php echo $resultP['product__img']?>"
                alt="">
            <h4 class="product-name"><?php echo $resultP['product__name']?></h4>
            <p class="product-price highlight"><?php echo number_format($resultP['product__cost']);?>đ</p>
        </a>
    </div>
<?php 
        }
    }
?>
</div>