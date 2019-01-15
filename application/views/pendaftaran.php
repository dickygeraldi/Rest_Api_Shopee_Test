<!DOCTYPE html>
<html>
<head>
	<title>PENDAFTARAN</title>
</head>
<body>
	<H1>PENDAFTARAN USER</H1>
	<form action="<?php echo base_url('index.php/Shoope_controller/register'); ?>" method="post">
		Masukkan Email :
		<input type="email" name="email" required><br />
		Masukkan Password :
		<input type="password" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br />
		Masukkan Nama :
		<input type="text" name="nama" required><br />
		<input type="submit" value="Daftar">
	</form>
</body>
</html>