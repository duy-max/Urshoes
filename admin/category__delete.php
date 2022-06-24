<?php 
    include "header.php";
?>

<?php 
    $category = new category;

    if(!isset($_GET['category__id']) || $_GET['category__id'] === NULL) {
        echo "<script>window.location = 'category__list.php'</script>";
    }
    else {
        $category__id = $_GET['category__id'];
    }

    $delete__category = $category->delete__category($category__id);
?>