<?php 
    include "header.php";
    include "slider.php";
?>

<?php 
    $category = new category;

    if(!isset($_GET['category__id']) || $_GET['category__id'] === NULL) {
        echo "<script>window.location = 'category__list.php'</script>";
    }
    else {
        $category__id = $_GET['category__id'];
    }

    $get__category = $category->get__category($category__id);

    if($get__category) {
        $result = $get__category->fetch_assoc();
    }
?>

<?php 
    $category = new category;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category__name  = $_POST['category__name'];
        $update__category = $category->update__category($category__id, $category__name);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-category__edit">
                <h1>Sửa danh mục</h1>
                <form action="" method="post">
                    <input required type="text" name="category__name" id="" placeholder="Nhập tên danh mục"
                     value="<?php echo $result['category__name']?>">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>