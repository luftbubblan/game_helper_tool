<?php
	$pageTitle = "Home";

	require('../src/config.php');
	require('../src/CRUD_functions.php');

	$items = $crudFunctions->fetchAllItems();

	echo "<pre>";
	print_r($items);
	echo "</pre>";

	include('layout/header.php');
?>

<div id="content">
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Link</th>
				<th>Acquired</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($items as $item) {?>
				<tr <?php echo ($item['Acquired']==1 ? 'id="acquired"' : 'id="notAcquired"');?>>
					<td>
						<?= $item['Name'] ?>
					</td>
					<td>
						<a href="<?= $item['Link'] ?>" target="_blank"><?= $item['Link'] ?></a>
					</td>
					<td>
						<form id="acquiredForm" action="" method="POST">
							<input type="hidden" name="id" value="<?= $item['Id'] ?>">
							<input type="submit" value="Item Acquired" <?php echo ($item['Acquired']==1 ? 'id="hidden"' : '');?>>
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Custom -->
<script>
	$("#acquiredForm").submit(function(){
		console.log($($(this)[0][0]).val())
		
		$crudFunctions->Acquired($(e.target[0]).val());
		
		return false;
	});
</script>

<?php include('layout/footer.php') ?>