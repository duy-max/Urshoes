<?php 
    include "header.php";
    include "slider.php";
?>

<?php
    $producttype = new producttype;
    $product = new product;

    if(!isset($_GET['product__id']) || $_GET['product__id'] === NULL) {
        echo "<script>window.location = 'product__list.php'</script>";
    }
    else {
        $product__id = $_GET['product__id'];
    }

    $get__product = $product->get__product($product__id);

    if($get__product) {
        $resultP = $get__product->fetch_assoc();
    }
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category__id  = $_POST['category__id'];
        $producttype__id  = $_POST['producttype__id'];
        $product__name  = $_POST['product__name'];
        $product__cost  = $_POST['product__cost'];
        $product__img = $_FILES['product__img']['name'];
        $product__img2 = $_FILES['product__img2']['name'];
        $product__img3 = $_FILES['product__img3']['name'];
        $product__img4 = $_FILES['product__img4']['name'];
        move_uploaded_file($_FILES['product__img']['tmp_name'], "uploads/".$_FILES['product__img']['name']);
        move_uploaded_file($_FILES['product__img2']['tmp_name'], "uploads/".$_FILES['product__img2']['name']);
        move_uploaded_file($_FILES['product__img3']['tmp_name'], "uploads/".$_FILES['product__img3']['name']);
        move_uploaded_file($_FILES['product__img4']['tmp_name'], "uploads/".$_FILES['product__img4']['name']);
        $update__product = $product->update__product($product__id, $category__id, $producttype__id, $product__name, $product__cost, $product__img, $product__img2, $product__img3, $product__img4);
    }
?>

        <div class="admin-content-right">
            <div class="admin-content-right-producttype__edit">
                <h1>Sửa sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <input required type="text" name="product__name" id="" placeholder="Tên sản phẩm" value="<?php echo $resultP['product__name']?>">
                    <select required name="category__id" id="category__id">
                        <option value="#">Chọn danh mục</option>
                        <?php 
                            $show__category = $product->show__category();
                            if ($show__category) {
                                while ($resultC = $show__category->fetch_assoc()) {
                        ?>
                        <option <?php if($resultC['category__id']==$resultP['category__id']) { echo 'selected';} ?> 
                        value="<?php echo $resultC['category__id'] ?>"><?php echo $resultC['category__name'] ?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    <select required name="producttype__id" id="producttype__id">
                        <option value="#">Chọn loại sản phẩm</option>
                        <?php 
                            $show__producttype = $producttype->show__producttype_by_categoryid($resultP['category__id']);
                            if ($show__producttype) {
                                while ($resultPT = $show__producttype->fetch_assoc()) {
                        ?>
                        <option <?php if($resultPT['producttype__id']==$resultP['producttype__id']) { echo 'selected';} ?> 
                        value="<?php echo $resultPT['producttype__id'] ?>"><?php echo $resultPT['producttype__name'] ?></option>
                        <?php 
                                }
                            }
                        ?>
                        
                    </select>
                    <input required type="text" name="product__cost" placeholder="Giá sản phẩm" value="<?php echo $resultP['product__cost'] ?>">
                    <br>
                    <label for="">Ảnh sản phẩm</label>
                    <input required type="file" name="product__img" value="./admin/uploads/<?php echo $resultP['product__img'] ?>">
                    <br>
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img2" value="<?php echo $resultP['product__img2'] ?>">
                    <br>
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img3" value="<?php echo $resultP['product__img3'] ?>">
                    <br>
                    <label for="">Ảnh sản phẩm</label>
                    <input type="file" name="product__img4" value="<?php echo $resultP['product__img4'] ?>">
                    <br>
                    <button type="submit" name="submit">Sửa</button> 
                </form>
            </div>
        </div>
    </section>
</body>

<script>
    $(document).ready(function() {
        $('#category__id').change(function() {
            var x = $(this).val();
            $.get("product__add_ajax.php", {category__id: x}, function(data) {
                $("#producttype__id").html(data);
            })
        })
    })
</script>