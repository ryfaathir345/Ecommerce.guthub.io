<?php
include("db.php");

if(isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  
  // Cek apakah user adalah admin
  $sql = "SELECT admin_id,type FROM tb_admin WHERE username = '$username' and password = '$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  
  // Jika user adalah admin, buat sesi admin dan redirect ke halaman admin
  if($count > 0 && $row['type'] == 'admin') {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["admin_id"] = $row["admin_id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["type"] = $row["type"];
        header("location: dashboard.php");
  }elseif ($count > 0 && $row['type'] == 'user') {
	  $_SESSION['login_user'] = $username;
    $_SESSION['admin_id'] = $row['admin_id'];
    header("location: index.php");
  } else {
    echo " Username atau password salah.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Tos Store</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="username" placeholder="Username" class="input-control">
			<input type="password" name="password" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn"><br>
      <a href="http://localhost/php/register.php" style="font-size: 14px; font-style: italic;">Belum Punya Akun? Registrasi Sekarang</a>
		</form>
		
	</div>
</body>
</html>