<!DOCTYPE html>
<html>
<head>
	<title>UBAH PENDAFTARAN</title>
</head>
<body>
	<H1>UBAH PENDAFTARAN</H1>
	<form action="<?php echo base_url('index.php/Welcome/update'); ?>" method="post">
		<?php
			foreach ($user->result() as $i) {
				?>
			 	EMAIL :
			 	<input type="email" name="email" value="<?php echo $i->email ?>"><br />
			 	NAMA :
			 	<input type="text" name="nama" value="<?php echo $i->nama ?>"><br />
			 	MASUKKAN PASSWORD :
			 	<input type="password" name="password"><br />
			 	NO HP :
			 	<input type="text" name="no_hp" value="<?php echo $i->no_hp ?>">

		<?php
			 } 
			 ?>
	</form>
</body>
</html>