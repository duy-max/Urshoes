<?php
    
    include_once "../database/database.php";

     if (!empty($_POST['limit']) || !empty($_POST['start']) ) {
        $limit = $_POST['limit'];
        $start = $_POST['start'];
        
        $sql = "select product.*, category.category__name, producttype.producttype__name 
                from product, category, producttype 
                where category.category__id = product.category__id
                and producttype.producttype__id = product.producttype__id
                order by product__id
                limit ".$start.", ".$limit."";
        $db = new Database;
        $result = $db->select($sql);
        if (!empty($result) && $result->num_rows > 0) {
            while($row = $result->fetch_array()) {
                echo '<tr>
                        <td>'.(++$start).'</td>
                        <td>'.$row['product__id'].'</td>
                        <td>'.$row['category__name'].'</td>
                        <td>'.$row['producttype__name'].'</td>
                        <td>'.$row['product__name'].'</td>
                        <td>'.number_format($row['product__cost']).'</td>
                        <td><img src="uploads/'.$row['product__img'].'" alt="" width="100" height="100"/></td>
                        <td>
                            <a href="product__edit.php?product__id='.$row['product__id'].'">Sửa</a> |
                            <a href="product__delete.php?product__id='.$row['product__id'].'">Xóa</a>
                        </td>
                    </tr>';
            }
        }
        else echo false;
    }

?>