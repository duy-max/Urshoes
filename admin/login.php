<?php
	include "../session/session.php";
	include "../database/database.php";
	include "../class/admin__class.php";
	Session::init();
	$admin = new admin;
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $admin__user = mysqli_real_escape_string($conn, $_POST['admin__user']);
        $admin__pass = md5(mysqli_real_escape_string($conn, $_POST['admin__pass']));
        $login__admin = $admin->login__admin($admin__user, $admin__pass);
    }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" /> -->
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="admin__user"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="admin__pass"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form>
	</section>
</div>
</body>
</html>