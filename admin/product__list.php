<?php 
    $title = "Danh sách sản phẩm";
    include "header.php";
    include "slider.php";
?>

<?php 
    $product = new product;
    $show__product = $product->show__product();
?>

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
                            <th>Sản phẩm</th>
                            <th>Giá (VNĐ)</th>
                            <th>Ảnh</th>
                            <th>Tùy biến</th>
                        </tr>
                    </thead>
                    <tbody id="load_data">
                        <!-- <?php 
                            // if($show__product) {
                            //     $i = 0;
                            //     while ($result = $show__product->fetch_assoc()) {
                            //         $i++;
                        ?> -->
                        <!-- <tr>
                            <td><?php// echo $i ?></td>
                            <td><?php// echo $result['product__id'] ?></td>
                            <td><?php// echo $result['category__name'] ?></td>
                            <td><?php// echo $result['producttype__name'] ?></td>
                            <td><?php// echo $result['product__name'] ?></td>
                            <td><?php// echo number_format($result['product__cost']) ?></td>
                            <td><img src="uploads/<?php// echo $result['product__img'] ?>" alt="" width="100" height="100"/></td>
                            <td>
                                <a href="product__edit.php?product__id=<?php// echo $result['product__id']?>">Sửa</a> |
                                <a href="product__delete.php?product__id=<?php// echo $result['product__id']?>">Xóa</a>
                            </td>
                        </tr>
                        <?php
                            //     }
                            // }
                        ?> -->
                    </tbody>
                </table>
                <button id="load-more">Tải thêm</button>
            </div>
        </div>
    </section>
    <div id="loading">
        <img src="./uploads/loading/Spinner1.gif" alt="">
    </div>
<script>
    $(document).ready(function() {
        let limit = 8;
        let start = 0;
        function load_product_ajax(limit, start) {
            $.ajax({
                url: "ajax-product.php",
                type: 'post',
                data: {
                    limit: limit,
                    start: start,
                },
                dataType: 'text',
                beforeSend: function() {
                    $('#loading').show(); 
                },
                success: function(result) {
                    if (result != false) {
                        $('#loading').hide();
                        $('#load_data').append(result)
                        action = true;

                    } else if (result == false) {
                        $('#loading').hide();
                        alert("Đã hết sản phẩm");
                        action = false;
                    }
                }
            })
        }
        load_product_ajax(limit, start);
        $('#load-more').click(function() {
            start = start + limit;
            load_product_ajax(limit, start);

        })
        
    })
    
</script>
</body>
</html>