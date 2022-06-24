<?php
   
    include "header.php";
?>

<style>
    .order-find {
        margin: 120px auto 0 auto;
        width: 900px;
        text-align: center;
    }

    .order-find table {
        margin: 0 auto;
        margin-top: 15px;
        border-top: 1px solid #ccc;
    }
    .order-find table th,
    .order-find table td {
        padding: 10px;
    }
    .order-find input {
        padding: 6px 20px;
        border: 1px solid #ccc;
        outline: none;
    }
    .order-find button {
        border: none;
        padding: 8px 16px;
        background-color: rgb(116, 191, 241);
        color: white;
        font-weight: bold;
        cursor: pointer;
    }
    .order-find button:hover {
        background-color: rgb(37, 160, 241);
    }
    .order-find h1.error {
        color: red;
    }
    .order-find h1.success {
        color: green;
    }
</style>


<?php
    $flag = false;
    $code = '';
    if (isset($_GET['code'])) {
        $flag = true;
        $db = new Database;
        $code = $_GET['code'];
        $sql = "select * from cart where id = '".$code."'";
        $result = $db->select($sql);
    }
?>
<div class="order-find">
    <h1>Tra cứu đơn hàng</h1>
   <form action="" method="get">
       <table>
           <tr>
               <th>Mã đơn hàng</th>
               <th><input type="text" name="code" value="<?php if ($code) echo $code;?>"></th>
               <th><button type="submit">TRA CỨU</button></th>
           </tr>
       </table>
   </form>
   <?php
    if (!empty($result) && $result->num_rows > 0) {
        $cart = $result->fetch_array();
        echo '<div id="result">
                <h1 class="success">THÔNG TIN ĐƠN HÀNG</h1>
                <table>
                    <tr>
                        <td>Họ và tên</td>
                        <td>Email</td>
                        <td>Số điện thoại</td>
                        <td>Địa chỉ giao hàng</td>
                        <td>Tình trạng</td>
                        
                    </tr>
                    <tr>
                        <th>'.$cart['fullname'].'</th>
                        <th>'.$cart['email'].'</th>
                        <th>'.$cart['phone'].'</th>
                        <th><span id="address-cart"></span></th>
                        <th><span id="status">'.$cart['status'].'</span></th>
                    </tr>
                </table>
                <input type="hidden" id="province" value="'.$cart['province'].'">
                <input type="hidden" id="district" value="'.$cart['district'].'">
                <input type="hidden" id="address" value="'.$cart['address'].'">
            </div>';
    }
    else {
        if ($flag)
            echo '<h1 class="error">ĐƠN HÀNG KHÔNG TỒN TẠI!!</h1>';
    }
   ?>
    
</div>
<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>

<script>
    $(document).ready(function(){
       if ($('#province').length) {
            const provinceKey = $('#province').val();
            const province = c[provinceKey];
            
            const districtKey = $('#district').val();
            const dataDistrict = arr[provinceKey];

            district = dataDistrict[districtKey];
            const address = $('#address').val();
            const txt = `${province} - ${district} - ${address}`;
            $('#address-cart').text(txt);

            const status = parseInt($('#status').text());
            if (status == 0 ) {
                var statusTxt = 'Chờ xử lý';
            } else if (status == 1) {
                var statusTxt = 'Chuẩn bị giao hàng'
            } else if (status == 2) {
                var statusTxt = 'Đang giao hàng'
            } else if (status == 3) {
                var statusTxt = 'Đã giao hàng'
            }
            $('#status').text(statusTxt);
        }

    })
</script>