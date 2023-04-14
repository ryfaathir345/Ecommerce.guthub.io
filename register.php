<?php
 $koneksi = mysqli_connect('localhost', 'root','', 'tosstore') or die(mysqli_error($koneksi));
    
 if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password1'];
    $passwor2 = $_POST['password2'];
    $admin_telp = $_POST['admin_telp'];
    $admin_email = $_POST['admin_email'];
    $admin_address = $_POST['admin_address'];
    $type = 'user';

    $cek_user = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'");
    $cek_login = mysqli_num_rows($cek_user);

    if ($cek_login > 0) {
        echo "<script>
            alert('user name telah terdaftar');
            window.location = 'login.php';
        </script>";
    }else {
        if ($password != $passwor2) {
            echo "<script>
                alert('Password Yang Diinputkan Tidak Sama');
                window.location = 'register.php';
            </script>";
        }else {
            // $password = md5($password);
            mysqli_query($koneksi, "INSERT INTO tb_admin VALUES ('','$username','$password','$admin_telp','$admin_email','$admin_address','$type') ");
            echo "<script>
            alert('data berhasil dikirim');
            window.location = 'login.php';
            </script>";
        }
    }

 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Register | Tos Store</title>
</head>
<body id="bg-login">>
        <div class="box-login">
        <h2>Register</h2>
        <form action="" method="POST">
			<input type="text" name="username" placeholder="Username" class="input-control">
			<input type="password" name="password1" placeholder="Password" class="input-control">
            <input type="password" name="password2" placeholder="Password" class="input-control">
			<input type="text" name="admin_telp" placeholder="Telepon" class="input-control">
			<input type="email" name="admin_email" placeholder="Email" class="input-control">
			<input type="text" name="admin_address" placeholder="Alamat" class="input-control">       
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
        </div>
</body>
</html>