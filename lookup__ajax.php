<?php include 'header.php'; ?>
<div class="row">
<?php
    $keyword = $_GET['keyword'];
    $category__id = $_GET['category__id'];
    if ($category__id === '') {
        $keyword__product = $product->lookup__product($keyword);
    } else {
        $keyword__product = $product->lookup__product__category__id($keyword, $category__id);
    }
?>
    <?php 
        if ($keyword__product) {
            while ($resultP = $keyword__product->fetch_assoc()) {
    ?>
        <div class="col l-4 m-4 c-6">
            <a href="./productdetail.php?product__id=<?php echo $resultP['product__id'] ?>" class="product">
                <img class="product-image" src="./admin/uploads/<?php echo $resultP['product__img']?>" alt="">
                <h4 class="product-name"><?php echo $resultP['product__name']?></h4>
                <p class="product-price highlight"><?php echo $resultP['product__cost']?>đ</p>
            </a>
        </div>
    <?php 
            }
        }
    ?>
</div>