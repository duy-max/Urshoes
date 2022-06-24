
<?php 
    include '../database/database.php';
    include "../class/product__class.php";
    $product = new product;
    $category__id = $_GET['category__id'];
?>


<?php 
    $show__producttype_ajax = $product->show__producttype_ajax($category__id);
    if ($show__producttype_ajax) {
        while ($resultPT = $show__producttype_ajax->fetch_assoc()) {
?>
<option <?php if($resultPT['producttype__id']==$resultPT['producttype__id']) { echo 'selected';} ?> value="<?php echo $resultPT['producttype__id']?>"><?php echo $resultPT['producttype__name']?></option>
<?php 
        }
    }
?>