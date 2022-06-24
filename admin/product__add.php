<?php 
    $title = "Thêm sản phẩm";
    include "header.php";
    include "slider.php";
?>

<?php 
    $product = new product;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $category__id  = $_POST['category__id'];
        $producttype__id = $_POST['producttype__id'];
        $product__name = $_POST['product__name'];
        $product__cost = $_POST['product__cost'];
        $product__img = $_FILES['product__img']['name'];
        $product__img2 = $_FILES['product__img2']['name'];
        $product__img3 = $_FILES['product__img3']['name'];
        $product__img4 = $_FILES['product__img4']['name'];
        move_uploaded_file($_FILES['product__img']['tmp_name'], "uploads/".$_FILES['product__img']['name']);
        move_uploaded_file($_FILES['product__img2']['tmp_name'], "uploads/".$_FILES['product__img2']['name']);
        move_uploaded_file($_FILES['product__img3']['tmp_name'], "uploads/".$_FILES['product__img3']['name']);
        move_uploaded_file($_FILES['product__img4']['tmp_name'], "uploads/".$_FILES['product__img4']['name']);
        $insert__product = $product->insert__product($category__id, $producttype__id, $product__name, $product__cost, $product__img, $product__img2, $product__img3, $product__img4);
    }
?>
<style>
    .admin-content {
        height: 100vh;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-product__add">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <input required type="text" name="product__name" id="" placeholder="Nhập tên sản phẩm">
                    <select required name="category__id" id="category__id">
                        <option value="#">Chọn danh mục</option>
                        <?php 
                            $show__category = $product->show__category();
                            if ($show__category) {
                                while ($result = $show__category->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result['category__id'] ?>"><?php echo $result['category__name'] ?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    <select required name="producttype__id" id="producttype__id">
                        <option value="#">Chọn loại sản phẩm</option>
                        
                    </select>
                    <input required type="text" name="product__cost" placeholder="Giá sản phẩm">
                    <br>
                    <label for="">Ảnh sản phẩm</label>
                    <input required type="file" name="product__img">
                    <br>

                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img2">
                    <br>

                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img3">
                    <br>

                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img4">
                    <br>
                    <!-- <label for="">Ảnh mô tả</label>
                    <input required type="file" name> -->
                    <button type="submit" name="submit">Thêm</button> 
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    $(document).ready(function() {
        $('#category__id').change(function() {
            var x = $(this).val();
            // alert($(this).val());
            $.get("product__add_ajax.php", {category__id: x}, function(data) {
                $("#producttype__id").html(data);
            })
        })
    })
</script>

</html>