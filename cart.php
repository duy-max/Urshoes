<?php
    include "header.php";
?>
<?php
    
     $cart = [];
    if (isset($_SESSION['cart']))
        $cart = $_SESSION['cart'];
    $count = count($cart);
   
?>
<style>
    .btn-delete {
        font-size: 18px;
        cursor: pointer;
        color: #666;
    }
</style>
        <!---------------------------------------- Cart ---------------------------------------->
        <div class="cart">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-8 m-12 c-12">
                        <div class="cart-detail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>SẢN PHẨM</th>
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>SL</th>
                                        <th>GIÁ (VNĐ)</th>
                                        <th>THÀNH TIỀN</th>
                                        <th>XÓA</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-detail">
                                    <?php
                                        $total = 0;
                                        foreach($cart as $item) {
                                            $total += $item['quantity'] * $item['product__cost'];
                                            echo '<tr>
                                                    <td>
                                                        <a href="./productdetail.php?product__id='.$item['product__id'].'">
                                                            <img src="./admin/uploads/'.$item['product__img'].'" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="">'.$item['product__name'].'</a>
                                                    </td>
                                                    <td>
                                                        <input type="number" id="quantity_'.$item['product__id'].'" value="'.$item['quantity'].'" onchange="updateQuantity('.$item['product__id'].')" min="1" style="width: 50px">
                                                    </td>
                                                    <td><span data-id="'.$item['product__cost'].'" id="product_cost_'.$item['product__id'].'">'.number_format($item['product__cost']).'</span></td>
                                                    <td><span data-id="'.$item['quantity'] * $item['product__cost'].'" id="totalCost_'.$item['product__id'].'">'.number_format($item['quantity'] * $item['product__cost']).'</span></td>
                                                    <td>
                                                        <i class="btn-delete fas fa-times" onclick="deleteItem('.$item['product__id'].')"></i>
                                                    </td>
                                                    </tr>';
                                                }
                                            $total = number_format($total);
                                    ?>
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col l-4 m-12 c-12">
                        <div class="cart-money">
                            <table>
                                <caption>TỔNG TIỀN GIỎ HÀNG</caption>
                                <tbody>
                                    <tr>
                                        <td>TỔNG SẢN PHẨM</td>
                                        <td><?=$count?></td>
                                    </tr>
                                    <tr>
                                        <td>TỔNG TIỀN HÀNG</td>
                                        <td id="total_1"><?=$total?>đ</td>
                                    </tr>
                                    <tr>
                                        <td>THÀNH TIỀN</td>
                                        <td id="total_2"><?=$total?>đ</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>TẠM TÍNH</td>
                                        <td id="total_3"><?=$total?>đ</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="button">
                                <a href="./index.php" class="continue">Tiếp tục mua sắm</a>
                                <a href="./order.php" class="pay">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    include "footer.php";
?>

<script>
    function deleteItem(id) {
        $.ajax({
                url: 'ajax-product.php',
                type: 'post',
                data: {
                    action: 'delete',
                    id: id,
                },
                dataType: 'text',
                success: function(result) {
                    location.reload();
                }
            })
    }

    function updateQuantity(id) {
        const newQuantity = $('#quantity_' + id).val();
        const productCost  = $('#product_cost_' + id).data('id');
        $.ajax({
                url: 'ajax-product.php',
                type: 'post',
                data: {
                    action: 'update',
                    id: id,
                    quantity: $('#quantity_' + id).val()
                },
                dataType: 'text',
                success: function(result) {
                    // Update cart detail
                    // Update new quantity
                    const tdQuantity = $('#quantity_' + id).parent();
                    var updateQuanityHtml = `<input type="number" id="quantity_${id}" value="${newQuantity}" onchange="updateQuantity(${id})" min="1" style="width: 50px">`;
                    tdQuantity.html(updateQuanityHtml)

                    //update new total cost
                    const tdCost = $('#totalCost_' + id).parent();
                    var updateCostHtml = `<span data-id="${newQuantity * productCost}" id="totalCost_${id}">${newQuantity * productCost}</span>`
                    tdCost.html(updateCostHtml)
                    
                    //Update total
                    const cartDetail = $('#cart-detail').children('tr')
                    let total = 0;
                    for (let i = 0; i < cartDetail.length;i++) {
                        const value = cartDetail.eq(i).children('td').eq(4).children('span').data('id');
                        total += value;
                        cartDetail.eq(i).children('td').eq(4).children('span').text(new Intl.NumberFormat().format(value));
                    }
                    total = new Intl.NumberFormat().format(total)
                    $('#total_1').text(total)
                    $('#total_2').text(total)
                    $('#total_3').text(total)

                }
            })
    }
</script>