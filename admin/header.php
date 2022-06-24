<?php 
    include "../session/session.php";
    Session::init();
?>
<?php 
    include "../database/database.php";
    include "../class/admin__class.php";
    include "../class/category__class.php";
    include "../class/producttype__class.php";
    include "../class/product__class.php";
    include "../class/customer__class.php";

    $login__check = Session::get('admin__login');
    $login__id = Session::get('admin__id');

    if(!$login__check) {
        echo("<script>location.href = './login.php';</script>");
    }

    $category = new category();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Trang quản trị  | <?php if (!empty($title)) echo $title; ?></title>
</head>
<body>
    <header>
        <?php 
            if (isset($_GET['admin__id'])) {
                Session::destroyadmin();
            }
        ?>
        <h1>
            <a href="?admin__id=<?php echo $login__id ?>">Đăng xuất</a>
        </h1>
    </header>
