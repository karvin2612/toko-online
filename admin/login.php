<?php
	session_start(); 
  //koneksi ke database
  $koneksi = new mysqli("localhost","root","","tubestoko");
  
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<center><h1>LOGIN ADMIN</h1>
	<form method="post">
		<table border="5">
			<tr>
				<td>Username</td>
				<td><input type="text" name="user"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass"></td>
			</tr>		
		</table>
		<button class="btn btn-primary" name="login">Login</button>
	</form>
	<?php  
	if (isset($_POST['login'])) 
	{
		$ambil = $koneksi ->query("SELECT * FROM admin WHERE username = '$_POST[user]' AND password='$_POST[pass]'");
		$yangcocok = $ambil->num_rows;
		if ($yangcocok==1) 
		{
			$_SESSION['admin']=$ambil->fetch_assoc();
			echo "<div class='alert alert-info'>LOGIN SUKSES</div>";
			echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		}
		else
		{
			echo "<div class='alert alert-danger'>LOGIN GAGAL</div>";
			echo "<meta http-equiv='refresh' content='1;url=login.php'>";
		}
	}
	?>
</center>
</body>
</html>