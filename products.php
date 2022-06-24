<?php
    include "header.php";
    
    $show__category = $producttype->show__category();
    $category__id = $_GET['category__id'];
    $producttype__id = $_GET['producttype__id'];
    if(isset($_GET['page'])){
        $page = $_GET['page'];
       
    }
    else{
        $page ='';
    }

    if($page==''|| $page ==1){
        $page=1;
        $start= 0;
    }
    else{
        $start = ($page*6) - 6;
    }
?>
<!---------------------------------------- Container ---------------------------------------->
<div class="container">
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 m-12 c-0">
                <div class="navigation">
                    <ul class="navigation-list">
                        <li>
                            <a href="./index.php">Trang chủ</a>
                            <span>&rarr;</span>
                        </li>
                        <li>
                            <a href="#">
                                <?php 
                                            $get__category = $category->get__category($category__id)->fetch_assoc();
                                            echo $get__category['category__name'];
                                        ?>
                            </a>
                            <span>&rarr;</span>
                        </li>
                        <li>
                            <a href="#" class="active">
                                <?php 
                                                $get__producttype = $producttype->get__producttype($producttype__id)->fetch_assoc();
                                                echo $get__producttype['producttype__name'];
                                            ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l-3 m-0 c-0">
                <nav class="category">
                    <ul>
                        <?php 
                                    while ($resultC = $show__category->fetch_assoc()){
                                        $show__producttype = $producttype->show__producttype_by_categoryid($resultC['category__id']);
                                        if ($show__producttype) {
                                ?>
                        <li class="category-detail">
                            <a href="#"><?php echo $resultC['category__name'] ?></a>
                            <ul>
                                <?php 
                                                while ($resultPT = $show__producttype->fetch_assoc()){
                                                    
                                        ?>
                                <li><a
                                        href="products.php?category__id=<?php echo $resultC['category__id']; echo "&producttype__id=" . $resultPT['producttype__id']?>"><?php echo $resultPT['producttype__name']?></a>
                                </li>
                                <?php 
                                                }
                                            }
                                            else continue;
                                        ?>
                            </ul>
                        </li>
                        <?php
                                    }
                                ?>
                    </ul>
                </nav>
            </div>

            <div class="col l-9 m-12 c-12">
                <div class="filter hide-on-mobile hide-on-tablet">
                    <div class="filter-header">
                        <span class="filter__sort">Sắp xếp theo</span>
                        <!-- <div class="btn">Phổ Biến</div>
                        <div class="btn btn-active">Mới Nhất</div>
                        <div class="btn">Bán Chạy</div> -->
                        <select name="price-sort" id="price-sort" class="price-selection">
                            <option value="lowtohigh" class="price-sort-option">Giá: Thấp đến cao</option>
                            <option value="hightolow" class="price-sort-option">Giá: Cao đến thấp</option>
                        </select>
                    </div>
                    <?php $show = $product->show__product_by_categoryid_producttypeid($category__id, $producttype__id);
                            $row_count = mysqli_num_rows($show);
                            $page_number = ceil($row_count/6);
                           
                        ?>
                    <div class="filter-footer">
                        <span class="page">
                            <span class="active"><?php echo $page?></span>
                            /
                            <span class="total"><?php echo $page_number?></span>
                        </span>
                        <?php  if($page == 1){   ?>
                        <div class="filter-footer-btn filter-footer-btn-left filter-footer-btn--disable">
                            <a href="#" class="filter-footer-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </div>
                        <?php  if($page == $page_number) { ?>

                        <div class="filter-footer-btn filter-footer-btn-right filter-footer-btn--disable">
                            <a href="#" class="filter-footer-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>

                        <?php  }  else {  ?>
                        <div class="filter-footer-btn filter-footer-btn-right">
                            <a href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page + 1)?>"
                                class="filter-footer-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <?php  } ?>

                        <?php  } elseif($page > 1 && $page <= $page_number -1 ) {?>
                        <div class="filter-footer-btn filter-footer-btn-left">
                            <a href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page - 1)?>"
                                class="filter-footer-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </div>
                        <div class="filter-footer-btn filter-footer-btn-right">
                            <a href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page + 1)?>"
                                class="filter-footer-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>
                        <?php }   else { ?>
                        <div class="filter-footer-btn filter-footer-btn-left">
                            <a href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page - 1)?>"
                                class="filter-footer-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </div>
                        <div class="filter-footer-btn filter-footer-btn-right filter-footer-btn--disable">
                            <a href="#" class="filter-footer-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </div>

                        <?php  }?>
                    </div>
                </div>

                <div class="products">
                    <div class="row">
                        <?php 
                                    $show__product = $product->show__product_by_categoryid_producttypeid_limit_6($category__id, $producttype__id,$start);
                                    if ($resultP = $show__product || $keyword__product) {
                                        while ($resultP = $show__product->fetch_assoc()) {
                                ?>
                        <div class="col l-4 m-4 c-6">
                            <a href="./productdetail.php?product__id=<?php echo $resultP['product__id'] ?>"
                                class="product">
                                <img class="product-image" src="./admin/uploads/<?php echo $resultP['product__img']?>"
                                    alt="">
                                <h4 class="product-name"><?php echo $resultP['product__name']?></h4>
                                <p class="product-price highlight"><?php echo number_format($resultP['product__cost']);?>đ</p>
                            </a>
                        </div>
                        <?php 
                                        }
                                    }
                                ?>
                    </div>
                </div>



                <div class="pagination">
                    <ul>
                        <?php if($page >  1 ){  ?>
                        <li class="btn prev ">
                            <a style="padding:5px 10px;"
                                href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page - 1)?>"><i
                                    class="fas fa-angle-left"></i></a>
                        </li> <?php }  ?>
                        <?php for($i=1;$i<=$page_number;$i++)  { ?>
                        <li class="numb" <?php if($page == $i){echo 'style="background-color: red;"';} else {echo'';}?>>
                            <a style="padding:5px 10px;"
                                href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo $i?>"><?php  echo $i?></a>
                        </li>
                        <?php  }?>
                        <?php  if($page <= $page_number-1){    ?>
                        <li class="btn next">
                            <a style="padding:5px 10px;"
                                href="products.php?category__id=<?php echo $category__id?>&producttype__id=<?php echo $producttype__id?>&page=<?php echo ($page + 1)?>"><i
                                    class="fas fa-angle-right"></i></a>
                        </li>
                        <?php }?>

                    </ul>
                </div>

            </div>
        </div>
    </div>


    <?php
    include "footer.php";
?>

<script>
    $(document).ready(function() {
        $('#price-sort').change(function() {
            const sort = $('#price-sort').val();
            const start = '<?php echo $start ?>';
            const category__id = '<?php echo $category__id ?>';
            const producttype__id = '<?php echo $producttype__id ?>';
            console.log(sort, start, category__id, producttype__id);
            $.get("products__ajax.php", {sort:sort, start: start, category__id: category__id, producttype__id: producttype__id}, function(data) {
			    $('.products').html(data);
		    })
        })
    })
</script>