<?php 
    $title = "Đơn hàng";
    include "header.php";
    include "slider.php";
?>

<?php 
    $db = new Database;
    $sql = "select * from cart";
    $result = $db->select($sql);
    
?>

<style>
    select {
        padding: 6px;
        width: 100%;
        margin: 0;
    }
    .admin-content {
        height: 100vh;
    }
    table tbody tr td:nth-child(3) {
        text-align: left;
    }
    .show-cart-detail {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.2);
    }
    .show-cart-detail .modal-body {
        width: 1000px;
        padding: 20px 10px;
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        text-align: center;
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
    }
    #btn-close-modal-show-cart-detail {
        cursor: pointer;
    }
    table {
        width: 100%;
        margin-top: 20px;
    }
    table th, td {
        border: 1px solid #ddd;
        padding: 6px;
    }
</style>

<div class="admin-content-right">
            <div class="admin-content-right-wrapper">
                <h1>Danh sách đơn hàng</h1>
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Thông tin</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 0;
                        while ($row = $result->fetch_array()) {
                            echo '<tr>
                                    <td>'.(++$i).'</td>
                                    <td>'.$row['id'].'</td>
                                    <td><strong>Họ tên: </strong>'.$row['fullname'].' <br> 
                                        <strong>Email: </strong>'.$row['email'].' <br> 
                                        <strong>Số điện thoại: </strong>'.$row['phone'].'</td>
                                        <td><span class="address-cart"></span></td>
                                        <td><span class="date-cart">'.$row['date'].'</span></td>
                                        <td><span class="total-cart">'.$row['total'].'</span></td>
                                    <td>'; 
                    ?>
                                        <select class="status" id="status_<?=$row['id']?>" onchange="updateStatus('<?=$row['id']?>')">
                    <?php
                                        if ($row['status'] == 0) {
                                            echo '<option selected value="0">Chờ xử lý</option>';
                                        }
                                        else echo '<option value="0">Chờ xử lý</option>';
                                        if ($row['status'] == 1) {
                                            echo '<option selected value="1">Chuẩn bị giao hàng</option>';
                                        }
                                        else echo '<option value="1">Chuẩn bị giao hàng</option>';
                                        if ($row['status'] == 2) {
                                            echo '<option selected value="2">Đang giao hàng</option>';
                                        }
                                        else echo '<option value="2">Đang giao hàng</option>';
                                        if ($row['status'] == 3) {
                                            echo '<option selected value="3">Đã giao hàng</option>';
                                        }
                                        else echo '<option value="3">Đã giao hàng</option>';
                                echo '</select>
                                    </td>';
                    ?>
                                    <td onclick="showCartDetail('<?=$row['id']?>')"><span class="fas fa-eye"></span></td>
                    <?php
                                echo '
                                    <input type="hidden" class="province" value="'.$row['province'].'">
                                    <input type="hidden" class="district" value="'.$row['district'].'">
                                    <input type="hidden" class="address" value="'.$row['address'].'">
                                </tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal show-cart-detail" id="modal-show-cart-detail">
        <div class="modal-body">
            <div class="modal-header">
                <h2>Chi tiết đơn hàng </h2>
                <i id="btn-close-modal-show-cart-detail" class="fas fa-times"></i>
            </div>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            <tbody id="cart-detail">
                
            </tbody>
            </table>
        </div>
    </div>
</body>

<script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
<script>
    $(document).ready(function(){
        $('#modal-show-cart-detail').hide();
        $('#btn-close-modal-show-cart-detail').click(function() {
            $('#modal-show-cart-detail').hide();
            $('#cart-detail').html('');
        })
    })
</script>
<script>
    $(document).ready(function(){
        const provinceList = $('.province');
        $.each(provinceList, function(index, value) {
            var provinceKey = $(this).val()
            let province = c[provinceKey];

            const districtKey = $('.district').eq(index).val();
            const dataDistrict = arr[provinceKey];
            const district = dataDistrict[districtKey];

            const address = $('.address').eq(index).val();
            const txt = `${province} - ${district} - ${address}`;
            $('.address-cart').eq(index).text(txt);

        })
        cssStatusSelect();
    })
</script>

<script>
    //css for status select
    function cssStatusSelect() {
        const status = $('.status')
        $.each(status, function(index, item) {
            let itemValue = $(this).val()
            if (itemValue == 0 ) {
                $(this).css({"background-color":"#ffd1d1"});
            } else if (itemValue == 1 ) {
                $(this).css({"background-color":"yellow"});
            } else if (itemValue == 2 ) {
                $(this).css({"background-color":"lightblue"});
            } else if (itemValue == 3 ) {
                $(this).css({"background-color":"#8aff7c"});
            }
        })
    }
    function updateStatusAjax(id, newStatus) {
        // const newStatus = $('#status_' + id).val()
        let option = $('#status_' + id).children('option')
        const arr = ['Chờ xử lý', 'Chuẩn bị giao hàng', 'Đang giao hàng', 'Đã giao hàng'];
        var html = ``;
        $.each(option, function(index, value) {
            if (index == newStatus) {
                html += `<option selected value="${newStatus}">${arr[newStatus]}</option>`;
            }
            else html += `<option value="${index}">${arr[index]}</option>`
        })
        $('#status_' + id).html(html)
        cssStatusSelect();
    }

</script>
<!-- Update status function -->
<script>
    function updateStatus(id) {
    $.ajax({
            url: 'ajax-cart.php',
            type: 'post',
            data: {
                action: 'updateStatus',
                id: id,
                status: $('#status_' + id).val()
            },
            dataType: 'text',
            success: function(result) {
                if (result == true) {
                    updateStatusAjax(id, $('#status_' + id).val())
                } 
            }
        })
    }
    function showCartDetail(id) {
        // alert(id)
        $.ajax({
            url: 'ajax-cart.php',
            type: 'get',
            data: {
                action: 'showCartDetail',
                id: id,
            },
            dataType: 'json',
            success: function(result) {
                if (result == false) {
                    alert('Thất bại!!');
                }
                else {
                    // console.log(result)
                    var str = ``;
                    $.each(result, function(index, item) {
                        str += `
                            <tr>
                                <td>${++index}</td>
                                <td>${item['MASP']}</td>
                                <td>${item['TENSP']}</td>
                                <td>${item['SL']}</td>
                                <td>${item['PRICE']}</td>
                            </tr>
                        `;
                    })
                    $('#cart-detail').html(str);
                    $('#modal-show-cart-detail').show();
                }
            }
        })
    }
</script>
</html>
