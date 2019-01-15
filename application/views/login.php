<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
</head>
<body>
	<H1>LOGIN USER</H1>
	<form action="<?php echo base_url('index.php/Shoope_controller/login'); ?>" method="post">
		Masukkan Email :
		<input type="email" name="email" required><br />
		Masukkan Password :
		<input type="password" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br />
		<input type="submit" value="Daftar">
	</form>
</body>
</html>