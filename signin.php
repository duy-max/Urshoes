<?php
    include "header.php";
?>
<?php
    if($login__check) {
        echo("<script>location.href = './index.php';</script>");
    }
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $customer__email = mysqli_escape_string($conn, $_POST['customer__email']);
        $customer__pass = (mysqli_escape_string($conn, $_POST['customer__pass']));
        $remember = false;
        if (isset($_POST['remember'])) {
            $remember = true;
        } 
        $login__customer = $customer->login__customer($customer__email, $customer__pass, $remember);
    }
?>

        <!---------------------------------------- Signin ---------------------------------------->
        <div class="sign signin">
            <div class="grid wide">
                <h3>Đăng nhập</h3>
                <div class="row">
                    <div class="col l-6 m-6 c-12">
                        <div class="sign-left">
                            <h4>Đăng nhập bằng tài khoản đã có:</h4>
                            <p>Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi tốt hơn!</p>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col l-5 m-5 c-12">
                                        <label for="signin-email" class="">
                                            Email của bạn:
                                        </label>
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <input required type="email" value="<?php if(isset($_COOKIE["customer__email"])) echo $_COOKIE["customer__email"] ?>" name="customer__email" id="signin-email" placeholder="Email của bạn...">
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                        <label for="signin-password" class="">
                                            Mật khẩu:
                                        </label>
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <input required type="password" value="<?php if(isset($_COOKIE["customer__pass"])) echo $_COOKIE["customer__pass"] ?>" name="customer__pass" id="signin-password" placeholder="Mật khẩu của bạn...">
                                    </div>
    
                                    <div class="col l-5 m-5 c-12">
                                    </div>

                                    <div class="col l-7 m-7 c-12">
                                        <label for="signin-save">
                                            <input type="checkbox" <?php if(isset($_COOKIE["customer__email"])) echo "checked" ?> name="remember" id="sign-save">
                                            Ghi nhớ đăng nhập?
                                        </label>
                                    </div>
                                    
                                    <div class="col l-5 m-5 c-12">
                                    </div>
    
                                    <div class="col l-7 m-7 c-12">
                                        <a href="">Quên mật khẩu?</a>
                                    </div>

                                    <div class="col l-5 m-5 c-12">
                                    </div>
    
                                    <div class="col l-7 m-7 c-12">
                                        <button type="submit" name="submit" class="sign-btn sign-btn-signin">Đăng nhập</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col l-6 m-6 c-12">
                        <div class="sign-right">
                            <h4>Khách hàng mới của UrShoes</h4>
                            <p>
                                Nếu bạn chưa có tài khoản trên urshoes.com, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.
                            </p>

                            <p>
                                Bằng cách cung cấp cho UrShoes thông tin chi tiết của bạn, quá trình mua hàng trên urshoes.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn!
                            </p>
                            
                            <a href="./signup.php" class="sign-btn sign-btn-signup">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    include "footer.php";
?>