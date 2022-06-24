<?php 
    include "header.php";
?>

<?php 
    $producttype = new producttype;

    if(!isset($_GET['producttype__id']) || $_GET['producttype__id'] === NULL) {
        echo "<script>window.location = 'producttype__list.php'</script>";
    }
    else {
        $producttype__id = $_GET['producttype__id'];
    }

    $delete__producttype = $producttype->delete__producttype($producttype__id);
?>