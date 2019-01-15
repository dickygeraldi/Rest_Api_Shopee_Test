<!DOCTYPE html>
<html>
<head>
	<title>PENDAFTARAN</title>
</head>
<body>
	<H1>PENDAFTARAN USER</H1>
	<form action="<?php echo base_url('index.php/Shoope_controller/currencies_submit'); ?>" method="post">
		FROM :
		<input type="text" name="from" required><br />
		TO :
		<input type="text" name="to" required><br />
		DATE :
		<input type="text" name="date" required><br />
        RATE :
		<input type="text" name="rate" required><br />
		<input type="submit" value="Daftar">
	</form>
</body>
</html>