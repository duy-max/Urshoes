<?php 
    $title = "Danh sách loại sản phẩm";
    include "header.php";
    include "slider.php";
?>

<?php 
    $producttype = new producttype;
    $show__producttype = $producttype->show__producttype();
?>
<style>
    .admin-content {
        height: 100vh;
    }
</style>
<div class="admin-content-right">
            <div class="admin-content-right-wrapper">
                <h1>Danh sách danh mục</h1>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Danh mục</th>
                            <th>Loại sản phẩm</th>
                            <th>Tùy biến</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($show__producttype) {
                                $i = 0;
                                while ($result = $show__producttype->fetch_assoc()) {
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['producttype__id'] ?></td>
                            <td><?php echo $result['category__name'] ?></td>
                            <td><?php echo $result['producttype__name'] ?></td>
                            <td>
                                <a href="producttype__edit.php?producttype__id=<?php echo $result['producttype__id']?>">Sửa</a> |
                                <a href="producttype__delete.php?producttype__id=<?php echo $result['producttype__id']?>">Xóa</a>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>