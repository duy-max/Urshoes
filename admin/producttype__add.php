<?php 
    $title = "Thêm loại sản phẩm";
    include "header.php";
    include "slider.php";
?>

<?php 
    $producttype = new producttype;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category__id  = $_POST['category__id'];
        $producttype__name = $_POST['producttype__name'];
        $insert__producttype = $producttype->insert__producttype($category__id, $producttype__name);
    }
?>

<style>
    .admin-content {
        height: 100vh;
    }
</style>
        <div class="admin-content-right">
            <div class="admin-content-right-producttype__add">
                <h1>Thêm danh mục</h1>
                <form action="" method="post">
                    <select required name="category__id" id="">
                        <option>Chọn danh mục</option>
                        <?php 
                            $show__category = $producttype->show__category();
                            if ($show__category) {
                                while ($result = $show__category->fetch_assoc()) {
                                    
                        ?>
                        <option value="<?php echo $result['category__id']?>"><?php echo $result['category__name']?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    <input required type="text" name="producttype__name" id="" placeholder="Nhập tên loại sản phẩm">
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>