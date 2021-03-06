    <?php
    session_start();
    $cart = [];
    if (isset($_SESSION['cart']))
    $cart = $_SESSION['cart'];
    if (empty($cart)) {
        header('Location: ./index.php');
    }
    include_once "database/database.php";
    if (!empty($_POST)) {
        $customer_id = '';
        if (!empty($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
        }
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $address = $_POST['address'];
        $total = $_POST['total'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_date = date("Y-m-d H:i:s");
        $id = md5(time().rand(1, 1000));
      
        $db = new Database;
        //cart
        $sql_cart = "insert into cart values ('".$id."', '".$customer_id."', '".$fullname."', '".$email."', '".$phone."', '".$province."', '".$district."', '".$address."', '".$current_date."', '".$total."', '0')";
        if ($db->insert($sql_cart)) {
            foreach ($cart as $item) {
                $product_id = $item['product__id'];
                $quanity = $item['quantity'];
                $price = $item['quantity'] * $item['product__cost'];
                $sql = "insert into cart_detail values('".$id."', '".$product_id."', '".$quanity."', '".$price."')";
                if ($db->insert($sql)) {
                    header("Location: ./order-process.php?madh=".$id."");
                    unset($_SESSION['cart']);
                }
            }
        }
        //cart detail (cart_id, product_id, quanity, price) 
       
        
    }
    include "header.php";

    $count = count($cart);
    if($login__check) {
        $customer__id = Session::get('customer__id');
        if (!empty($customer__id)) {
            $db = new Database;
            $result = $db->select("SELECT * FROM customer WHERE customer__id = '$customer__id'");
            $customer = $result->fetch_array();
        }
    }
    
?>



        <!---------------------------------------- Order-1 ---------------------------------------->
        <div class="order-1">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-7 m-7 c-12 left">
                        
                        <div class="order-1-info">
                            <h4>Vui l??ng ch???n ?????a ch??? giao h??ng</h4>
                            <?php
                                if(empty($login__check)) {
                                    echo '<div class="order-1-info-way">
                                            <a href="./signin.php">
                                                <i class="fas fa-sign-in-alt"></i>
                                                ????ng nh???p (N???u b???n ???? c?? t??i kho???n c???a IVY)
                                            </a>
                                            <br>
                                            <a href="./signup.php">
                                                <i class="fas fa-sign-in-alt"></i>
                                                ????ng k?? (T???o m???i t??i kho???n v???i th??ng tin b??n d?????i)
                                            </a>
                                            <br>
                                            <label for="guest">
                                                <input type="radio" class="buy-type" id="guest" checked>
                                                <span>Kh??ch l???</span> (N???u b???n kh??ng mu???n l??u l???i th??ng tin)
                                            </label>
                                        </div>';
                                }
                            ?>
   
                                <div class="pay-info sign signup">
                                    <form action="" method="post">
                                    <?php 
                                        if($login__check) {
                                            echo '<input type="hidden" name="customer_id" value="'.$customer__id.'">';
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-lastname">
                                                <span>H??? t??n:<span class="highlight">*</span> </span>
                                                <br>
                                                <input required name="fullname" type="text" value="<?php if($login__check) echo $customer['customer__name'] ?>" id="signup-lastname" placeholder="H???...">
                                            </label>
                                        </div>
                                        
                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-email">
                                                <span>Email:<span class="highlight">*</span> </span>
                                                <br>
                                                <input required name="email" type="email" value="<?php if($login__check) echo $customer['customer__email'] ?>" id="signup-email" placeholder="Email...">
                                            </label>
                                        </div>

                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-phone">
                                                <span>??i???n tho???i:<span class="highlight">*</span> </span>
                                                <br>
                                                <input required name="phone" type="text" value="<?php if($login__check) echo $customer['customer__phone'] ?>" id="signup-phone" placeholder="??i???n tho???i...">
                                            </label>
                                        </div>
                                        
                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-province">
                                                <span>T???nh/TP:<span class="highlight">*</span> </span>
                                                <br>
                                                <select required name="province" id="signup-province">
                                                    <?php 
                                                        if($login__check) 
                                                            echo '<option value="'.$customer['customer__province'].'"></option>';
                                                    ?>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-district">
                                                <span>Qu???n/Huy???n:<span class="highlight">*</span> </span>
                                                <br>
                                                <select required name="district" id="signup-district">
                                                <?php 
                                                        if($login__check) 
                                                            echo '<option value="'.$customer['customer__district'].'"></option>';
                                                ?>
                                                </select>
                                            </label>
                                        </div>
                                        <!-- <div class="col l-12 m-12 c-12">
                                            <label for="signup-ward">
                                                <span>Ph?????ng/X??:<span class="highlight">*</span> </span>
                                                <br>
                                                <select name="" id="signup-ward">
                                                    <option>Ch???n Ph?????ng/X??</option>
                                                    <option></option>
                                                </select>
                                            </label>
                                        </div> -->
                                        <div class="col l-12 m-12 c-12">
                                            <label for="signup-address">
                                                <span>?????a ch???:<span class="highlight">*</span> </span>
                                                <br>
                                                <?php 
                                                    if($login__check) 
                                                        echo '<input required name="address" value="'.$customer['customer__address'].'" id="signup-address"';
                                                ?>
                                                <input required name="address" id="signup-address" placeholder="Vui l??ng ??i???n ch??nh x??c th??ng tin ?????a ch???: s???, ???????ng, ph?????ng/x??">
                                            </label>
                                        </div>
                                        <input id="total-post" type="hidden" name="total" value="">
                                        <button type="submit" class="pay">?????t h??ng</button>

                                        <!-- <div class="col l-6 m-6 c-12">
                                            <label for="signup-password" class="label-pass">
                                                <span>M???t kh???u:<span class="highlight">*</span> </span>
                                                <br>
                                                <input required type="password" name="" id="signup-password" placeholder="M???t kh???u...">
                                            </label>
                                        </div>
                                        <div class="col l-6 m-6 c-12">
                                            <label for="signup-passwordagain" class="label-pass">
                                                <span>Nh???p l???i m???t kh???u:<span class="highlight">*</span> </span>
                                                <br>
                                                <input required type="password" name="" id="signup-passwordagain" placeholder="Nh???p l???i m???t kh???u...">
                                            </label>
                                        </div> -->
                                    </div>
                                    </form>

                                </div>

                        </div>
                    </div>
    
                    <div class="col l-5 m-5 c-12 right">
                        <div class="order-1-money">
                            <table>
                                <thead>
                                    <tr>
                                        <th>T??n s???n ph???m</th>
                                        <th>S??? l?????ng</th>
                                        <th>Th??nh ti???n</th>
                                    </tr>
                                </thead>
                                <?php
                                    $total = 0;
                                    foreach($cart as $item) {
                                        $total += $item['quantity'] * $item['product__cost'];
                                        echo '<tr>
                                                <td>
                                                    <a href="">'.$item['product__name'].'</a>
                                                </td>
                                                <td>
                                                    <span>'.$item['quantity'].'</span>
                                                </td>
                                                <td>'.number_format($item['quantity'] * $item['product__cost']).'??</td>
                                            </tr>';
                                    }
                                    ?>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>T???ng</td>
                                        <td></td>
                                        <td><?=number_format($total)?>??</td>
                                        <input id="total-show" type="hidden" value="<?=$total?>">
                                    </tr>
                                </tfoot>
                            </table>
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
        $('#total-post').val($('#total-show').val())
    })
</script>
    
<!-- <script>
    userSignIn = document.getElementById('user-register');
    buyTypes = document.querySelectorAll('.buy-type');
    passLabels = document.querySelectorAll('.label-pass');

    buyTypes.forEach((buyType) => {
        buyType.onclick = () => {
            if (userSignIn.checked) {
                passLabels.forEach((passLabel) => {
                    passLabel.classList.add('display');
                })
            }
            else {
                passLabels.forEach((passLabel) => {
                    passLabel.classList.remove('display');
                })
            }
        }
    })
</script> -->

<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
<script>
    $(document).ready(function() {
        const selectProvince = $('#signup-province')
        const selectDistrict = $('#signup-district')
        // Load address from databse
        let htmlProvinceFromDb = ``;
        for(let key in c) {
            if (selectProvince.val() == key)
            htmlProvinceFromDb += `<option selected value="${key}">${c[key]}</option>`
                else htmlProvinceFromDb += `<option value="${key}">${c[key]}</option>`
        }
        selectProvince.html(htmlProvinceFromDb)
        const dataDistrict = arr[selectProvince.val()];
        let htmlDistrictFromDb = ``;
        for(let key in dataDistrict) {
            if (selectDistrict.val() == key)
            htmlDistrictFromDb += `<option selected value="${key}">${dataDistrict[key]}</option>`
                else htmlDistrictFromDb += `<option value="${key}">${dataDistrict[key]}</option>`
        }
        selectDistrict.html(htmlDistrictFromDb)

        
        //update address
        selectProvince.change(function() {
            const keyProvince = selectProvince.val();
            const dataDistrict = arr[keyProvince];
            let htmlDistrict = ``;
            for(let key in dataDistrict) {
                htmlDistrict += `<option value="${key}">${dataDistrict[key]}</option>`
            }
            selectDistrict.html(htmlDistrict)
        })
    })

 </script>

