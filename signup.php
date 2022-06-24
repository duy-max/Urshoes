<?php
    include "header.php";
?>

<?php 
    $customer = new customer;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $customer__name = $_POST['customer__name'];
        $customer__email = $_POST['customer__email'];
        $customer__phone = $_POST['customer__phone'];
        $customer__province = $_POST['customer__province'];
        $customer__district = $_POST['customer__district'];
        $customer__ward = '';
        $customer__address = $_POST['customer__address'];
        $customer__pass = md5($_POST['customer__pass']);
        $insert__customer = $customer->insert__customer($customer__name, $customer__email, $customer__phone, $customer__province, $customer__district, $customer__ward, $customer__address, $customer__pass);
    }
?>

        <!---------------------------------------- Signup ---------------------------------------->
        <div class="sign signup">
            <div class="grid wide">
                <h3>Đăng ký</h3>
                

                <div class="row">
                    <div class="col l-12 m-12 c12">
                        <?php 
                            if (isset($insert__customer)) {
                                echo $insert__customer;
                            }
                        ?>

                    </div>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col l-6 m-6 c-12">
                            <div class="sign-left">
                                <h4>Thông tin khách hàng</h4>
                                <div class="row">
                                    <div class="col l-6 m-6 c-12">
                                        <label for="signup-lastname">
                                            <span>Họ tên:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required type="text" name="customer__name" id="signup-lastname" placeholder="Họ tên...">
                                        </label>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <label for="signup-email">
                                            <span>Email:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required type="email" name="customer__email" id="signup-email" placeholder="Email...">
                                        </label>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <label for="signup-phone">
                                            <span>Điện thoại:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required type="text" name="customer__phone" id="signup-phone" placeholder="Điện thoại...">
                                        </label>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <label for="signup-province">
                                            <span>Tỉnh/TP:<span class="highlight">*</span> </span>
                                            <br>
                                            <select required name="customer__province" id="signup-province">
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col l-6 m-6 c-12">
                                        <label for="signup-district">
                                            <span>Quận/Huyện:<span class="highlight">*</span> </span>
                                            <br>
                                            <select required name="customer__district" id="signup-district">
                                                <option selected disabled value="">Chọn Quận/Huyện</option>
                                            </select>
                                        </label>
                                    </div>
                                    <!-- <div class="col l-6 m-6 c-12">
                                        <label for="signup-ward">
                                            <span>Phường/Xã:<span class="highlight">*</span> </span>
                                            <br>
                                            <select required name="customer__ward" id="signup-ward">
                                                <option>Chọn Phường/Xã</option>
                                                <option></option>
                                            </select>
                                        </label>
                                    </div> -->
                                    <div class="col l-12 m-12 c-12">
                                        <label for="signup-address">
                                            <span>Địa chỉ:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required name="customer__address" id="signup-address" placeholder="Vui lòng điền chính xác thông tin địa chỉ: số, đường, phường/xã">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col l-6 m-6 c-12">
                            <div class="sign-right">
                                <h4>Thông tin mật khẩu</h4>
                                <div class="row">
                                    <div class="col l-12 m-12 c-12">
                                        <label for="signup-password">
                                            <span>Mật khẩu:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required type="password" name="customer__pass" id="signup-password" placeholder="Mật khẩu...">
                                        </label>
                                    </div>
                                    <div class="col l-12 m-12 c-12">
                                        <label for="signup-passwordagain">
                                            <span>Nhập lại mật khẩu:<span class="highlight">*</span> </span>
                                            <br>
                                            <input required type="password" name="" id="signup-passwordagain" placeholder="Nhập lại mật khẩu...">
                                        </label>
                                    </div>

                                    <div class="col l-12 m-12 c-12">
                                        <p>Bằng việc đăng ký, bạn đã đồng ý với các điều khoản của UrShoes</p>
                                    </div>
                                </div>
                                
                                <button href="" name="submit" type="submit" id="submit" class="sign-btn sign-btn-signup">Đăng ký</button>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    <script src='https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js'></script>
    <script>
        const selectProvince = $('#signup-province')
        const selectDistrict = $('#signup-district')
        let html = `<option selected disabled value="">Chọn Tỉnh/TP</option>`;
         for(let key in c) {
            html += `<option value="${key}">${c[key]}</option>`
        }
        selectProvince.html(html)
        

        selectProvince.change(function() {
            const keyProvince = selectProvince.val();
            const dataDistrict = arr[keyProvince];
            let htmlDistrict = ``;
            for(let key in dataDistrict) {
                htmlDistrict += `<option value="${key}">${dataDistrict[key]}</option>`
            }
            selectDistrict.html(htmlDistrict)
        })

    </script>
    <script>
        submit.onclick = function() {
            if (document.getElementById('signup-password').value !== document.getElementById('signup-passwordagain').value) {
                console.log(document.getElementById('signup-password'));
                alert('Vui long nhap lai dung password');
                return false;
            }
        }
    </script>

<?php
    include "footer.php";
?>