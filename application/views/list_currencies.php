<!DOCTYPE html>
<html>
<head>
	<title>FORM</title>
</head>
<body>
<H1>TREND EXCHANGE RATE 2018</H1>

<div><a href="<?php echo base_url('index.php/Shoope_controller/currencies_form'); ?>">Tambah </a></div>
<div><a href="<?php echo base_url('index.php/Shoope_controller/list_get_trend'); ?>">Trend </a></div>
<div><a href="<?php echo base_url('index.php/Shoope_controller/add_form'); ?>">Add Exchange </a></div>
<form action="<?php echo base_url('index.php/Shoope_controller/list_currencies'); ?>" method="post">
		Masukkan Date :
		<input type="text" name="date_from" required>
		<input type="submit" value="Search"><br/>
	</form>
	<table>
		<thead>
			<tr>
			<th>FROM</th>
			<th>TO</th>
			<th>RATE</th>
            <th>average 7 days</th>
		</tr>
		</thead>
		<tbody>
			<?php 
				// $field = json_decode($data_new);
				// print $field->data_main;
				
				foreach($list->result() as $rcrd){
					?>
					<tr>
						<td><?php echo $rcrd->from; ?></td>
						<td><?php echo $rcrd->to; ?></td>
                        <td><?php echo $rcrd->rate; ?></td>
						
				<?php } ?>
				
				<?php 

				foreach($avg->result() as $rcrd){
					?>
						<?php $data = sprintf('%0.5f', $rcrd->average); ?>
						<td><?php echo $data; ?></td>
					</tr>	
				<?php } ?>
			
		</tbody>
	</table>
</body>
</html>