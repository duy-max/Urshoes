<?php 
    include "header.php";
    if (isset($_GET['q'])) {
        $keyword = $_GET['q'];
        $keyword__product = $product->lookup__product($keyword);
    }
?>

        <!---------------------------------------- Container ---------------------------------------->
        <div class="container">
            <div class="grid wide">
                <div class="row">
                    <p style="margin-left: 16px; margin-bottom: 16px; padding-right: 16px;">Kết quả tìm kiếm cho <span style="font-weight: bold;"><?php echo $keyword ?></span></p>
                    <select name="filter__lookup" id="filter__lookup">
                        <option value="">Tất cả</option>
                        <?php   
                            $result = $producttype->show__producttype1();
                            while ($result1 = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result1['category__id'] ?>"><?php echo $result1['category__name'] ?></option>
                        <?php        
                            }
                        ?>
                    </select>
                    <div class="col l-12 m-12 c-12">
                        <div class="products">
                            <div class="row">
                                <?php 
                                    if ($keyword__product) {
                                        while ($resultP = $keyword__product->fetch_assoc()) {
                                ?>
                                    <div class="col l-4 m-4 c-6">
                                        <a href="./productdetail.php?product__id=<?php echo $resultP['product__id'] ?>" class="product">
                                            <img class="product-image" src="./admin/uploads/<?php echo $resultP['product__img']?>" alt="">
                                            <h4 class="product-name"><?php echo $resultP['product__name']?></h4>
                                            <p class="product-price highlight"><?php echo $resultP['product__cost']?>đ</p>
                                        </a>
                                    </div>
                                <?php 
                                        }
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
    $(document).ready(function() {
        $('#filter__lookup').change(function() {
            const keyword = '<?php echo $keyword ?>';
            const category__id = $('#filter__lookup').val();
            console.log(keyword, category__id);
            $.get("lookup__ajax.php", {keyword:keyword, category__id: category__id}, function(data) {
			    $('.products').html(data);
		    })
        })
    })
</script>