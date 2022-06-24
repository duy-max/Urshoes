<?php 
    include "header.php";
?>

<?php 
    $product = new product;

    if(!isset($_GET['product__id']) || $_GET['product__id'] === NULL) {
        echo "<script>window.location = 'product__list.php'</script>";
    }
    else {
        $product__id = $_GET['product__id'];
    }

    $delete__product = $product->delete__product($product__id);
?>