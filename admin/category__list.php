<?php 
    $title = "Danh sách danh mục";
    include "header.php";
    include "slider.php";
?>

<?php 
    $category = new category;
    $show__category = $category->show__category();
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
                            <th>Tùy biến</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($show__category) {
                                $i = 0;
                                while ($result = $show__category->fetch_assoc()) {
                                    $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['category__id'] ?></td>
                            <td><?php echo $result['category__name'] ?></td>
                            <td>
                                <a href="category__edit.php?category__id=<?php echo $result['category__id']?>">Sửa</a> |
                                <a href="category__delete.php?category__id=<?php echo $result['category__id']?>">Xóa</a>
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