<?php
    include 'header.php';
    if (isset($_GET['product__id'])) {
        $product__id = $_GET["product__id"];
        $get__product = $product->get__product($product__id);
        $resultP = $get__product->fetch_assoc();
    }

    $login__check = Session::get('customer__login');
    $customer__id = (int)Session::get('customer__id');
    if(isset($_POST['comment'])) {
        $product__id = (int)$_POST['product__id'];
        $comment__content = $_POST['comment__content'];
        $comment__content =  filter_var($comment__content, FILTER_SANITIZE_STRING);
        $insert__comment = $comment->insert__comment($customer__id, $product__id, $comment__content);

    }

?>
        <!---------------------------------------- Product Detail ---------------------------------------->
        <div class="product-detail">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-8 m-12 c-12">
                        <div class="product-imgs">
                            <div class="row">
                                <div class="col l-6 m-6 c-6">
                                    <img src="./admin/uploads/<?php if (isset($_GET['product__id'])) echo $resultP['product__img']?>" alt="">
                                </div>
                                <div class="col l-6 m-6 c-6">
                                    <img src="./admin/uploads/<?php if (isset($_GET['product__id'])) echo $resultP['product__img2']?>" alt="">
                                </div>
                                <div class="col l-6 m-6 c-6">
                                    <img src="./admin/uploads/<?php if (isset($_GET['product__id'])) echo $resultP['product__img3']?>" alt="">
                                </div>
                                <div class="col l-6 m-6 c-6">
                                    <img src="./admin/uploads/<?php if (isset($_GET['product__id'])) echo $resultP['product__img4']?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col l-4 m-12 c-12">
                        <div class="product-container">
                            <div class="product-heading">
                                <h3 class="product-name"><?php if (isset($_GET['product__id'])) echo $resultP['product__name'] ?></h3>
                                <span class="product-cost"><?php if (isset($_GET['product__id'])) echo number_format($resultP['product__cost']) ?></span>
                            </div>

                            <!-- <form action="" method="post"> -->
                              
                                <label for="">Số lượng</label>
                                <input type="number" id="quantity" value="1" min="1">

                                <button type="button" id="productSubmit" class="product-submit" onclick="addToCart(<?=$product__id?>)">Đặt hàng</button>
                            <div class="comments-heading">
                                <h3 class="comments-heading-title">Bình luận</h2>
                            </div>

                            <!-- </form> -->

                            <!-- <form action="" method="post">
                                <input type="hidden" name="color" id="color">

                                <input type="hidden" name="size" id="size">

                                <input type="hidden" name="product__quantity" id="productQuantity" value="1">
    
                                
                                <button type="submit" name="addcart" id="productAddCart" class="product-addcart">Thêm vào giỏ</button>
                            </form> -->
                            <div class="scroll-table" style=" height: 300px; overflow-y: auto;">
                                <table  class="comments"style=" width:100%;">
                                    <?php 
                                        $show__comment = $comment->show__comment($_GET['product__id']);
                                        if ($show__comment) {
                                            while($resultCMT = $show__comment->fetch_assoc()) {

                                    ?>
                                    <tr class="comment" >
                                       <td style="margin-bottom: 12px;border: 2px double #b1154a;height: 50px;">
                                        <p style="font-weight:bold;"><?php echo $resultCMT['customer__name'] ?></p>
                                        <p><?php echo $resultCMT['comment__content'] ?></p>
                                       </td>
                                    </tr>
                                    <?php 
                                            }
                                        }
                                    ?>
                                </table>
                            </div>

                            <?php 
                                if($login__check) {
                                    echo "    <form action='' method='post'>";
                                    echo "        <p for=''>Nhập bình luận</p>";
                                    echo "        <input name='comment__content' type='text'>";
                                    echo "        <input name='product__id' type='hidden' value='";
                                    echo $resultP['product__id'];
                                    echo "'>";
                                    
                                    echo "<button type='submit' name='comment' class='product-submit'>Gửi</button>
                                    </form>"
                                    
                                    ;
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php

    include "footer.php";
?>

<script>
    function addToCart(id) {
        $.ajax({
                url: 'ajax-product.php',
                type: 'post',
                data: {
                    action: 'add',
                    id: id,
                    quantity: $('#quantity').val()
                },
                dataType: 'text',
                success: function(result) {
                    location.reload();
                }
            })
    }
           
    
</script>