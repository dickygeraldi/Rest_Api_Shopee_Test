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
	<div><a href="<?php echo base_url('index.php/Shoope_controller/form'); ?>">Home </a></div>
    <table>
		<thead>
			<th>FROM</th>
			<th>TO</th>
			<th>AVERAGE</th>
			<th>VARIANCE</th>
		</tr>
		</thead>
		<tbody>
			<?php 
				$detail = $trend->row();
			?>
			
			<tr>
				<td><?php echo $detail->from; ?></td>
				<td><?php echo $detail->to; ?></td>
				<?php $data_average = sprintf('%0.5f', $detail->average); 
						$data_variance = sprintf('%0.5f', $detail->variance);
					?>
				<td><?php echo $data_average; ?></td>
				<td><?php echo $data_variance; ?></td>
			</tr>

		</tbody>
	</table>

	<table>
		<thead>
				<th>DATE</th>
				<th>RATE</th>
			</tr>
		</thead>
	
		<tbody>
			<?php 
				foreach($list->result() as $record){
			?>
			
			<tr>
				<td><?php echo $record->date; ?></td>
				<td><?php echo $record->rate; ?></td>
			</tr>
				<?php } ?>

			</tbody>
	</table>
</body>
</html>
