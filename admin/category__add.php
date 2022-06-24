<?php 
    $title = "Thêm danh mục";
    include "header.php";
    include "slider.php";
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $category__name  = $_POST['category__name'];
        $insert__category = $category->insert__category($category__name);
    }
?>

<style>
    .admin-content {
        height: 100vh;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-category__add">
                <h1>Thêm danh mục</h1>
                <form action="" method="post">
                    <input required type="text" name="category__name" id="" placeholder="Nhập tên danh mục">
                    <button type="submit" name="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>