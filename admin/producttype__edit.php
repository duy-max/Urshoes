<?php 
    include "header.php";
    include "slider.php";
?>

<?php 
    $producttype = new producttype;

    if(!isset($_GET['producttype__id']) || $_GET['producttype__id'] === NULL) {
        echo "<script>window.location = 'producttype__list.php'</script>";
    }
    else {
        $producttype__id = $_GET['producttype__id'];
    }

    $get__producttype = $producttype->get__producttype($producttype__id);

    if($get__producttype) {
        $resultPT = $get__producttype->fetch_assoc();
    }
?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category__id  = $_POST['category__id'];
        $producttype__name = $_POST['producttype__name'];
        $update__producttype = $producttype->update__producttype($producttype__id, $category__id, $producttype__name);
    }
?>

<div class="admin-content-right">
            <div class="admin-content-right-producttype__edit">
                <h1>Sửa loại sản phẩm</h1>
                <form action="" method="post">
                    <select required name="category__id" id="">
                        <option>Chọn danh mục</option>
                        <?php 
                            $show__category = $producttype->show__category();
                            if ($show__category) {
                                while ($result = $show__category->fetch_assoc()) {
                                    
                        ?>
                        <option <?php if($result['category__id']==$resultP['category__id']) { echo 'selected';} ?> value="<?php echo $result['category__id']?>"><?php echo $result['category__name']?></option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                    <input required type="text" name="producttype__name" id="" placeholder="Nhập tên loại sản phẩm" value="<?php echo $resultPT['producttype__name']?>">
                    <button type="submit">Sửa</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>