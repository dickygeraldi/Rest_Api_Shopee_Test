<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>
</head>
<body>
<H1>TREND EXCHANGE RATE 2018</H1>

<div><a href="<?php echo base_url('index.php/Shoope_controller/currencies_form'); ?>">Tambah </a></div>
<div><a href="<?php echo base_url('index.php/Shoope_controller/get_exchange_trend'); ?>">Trend </a></div>
<div><a href="<?php echo base_url('index.php/Shoope_controller/add_form'); ?>">Add Exchange </a></div>
<form action="<?php echo base_url('index.php/Shoope_controller/list_currencies'); ?>" method="post">
		Masukkan Date :
		<input type="text" name="date_from" required><br />
		<input type="submit" value="Daftar">
	</form>
	<table>
		<thead>
			<tr>
			<th>FROM</th>
			<th>TO</th>
			<th>DELETE</th>
		</tr>
		</thead>
		<tbody>
			<?php 
				foreach($data->result() as $rcrd){
					?>
					<tr>
						<td><?php echo $rcrd->from; ?></td>
						<td><?php echo $rcrd->to; ?></td>
						<td><a href="<?php echo base_url();?>index.php/Shoope_controller/hard_remove_exchange_rate/<?php echo $rcrd->id; ?>">[]</td>
		  			</tr>
				<?php } ?>
			?>
		</tbody>
	</table>
</body>
</html>