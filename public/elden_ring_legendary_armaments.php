<?php
	$pageTitle = "LEGENDARY ARMAMENTS";

	require('../src/config.php');
	require('../src/CRUD_functions.php');

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	
	if(isset($_POST['acquiredFormBtn'])) {
		$crudFunctions->AcquiredLegendaryArmaments($_POST['id']);
	}
	
	if(isset($_POST['newItemFormBtn'])) {
		$crudFunctions->NewLegendaryArmaments($_POST['name'], $_POST['customLink']);
	}
	
	if(isset($_POST['deleteFormBtn'])) {
			$crudFunctions->DeleteLegendaryArmaments($_POST['id']);
		}
		
		$items = $crudFunctions->fetchAllLegendaryArmaments();
		// echo "<pre>";
		// print_r($items);
		// echo "</pre>";

	include('layout/header.php');
?>

<div id="legendary-armaments-container">
	<table>
		<thead>
			<tr>
				<th>Item</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($items as $item) { ?>
				<tr <?php echo ($item['acquired']==1 ? 'id="acquired"' : 'id="notAcquired"');?>>
					<td>
						<a href="<?= $item['itemLink'] ?>" target="_blank"><?= $item['itemName'] ?></a>
					</td>
					<td>
						<?php if(!$item['acquired']) { ?>
							<form id="acquiredForm" action="" method="POST">
								<input type="hidden" name="id" value="<?= $item['id'] ?>">
								<input type="submit" name="acquiredFormBtn" value="Item Acquired">
							</form>
						<?php } else { ?>
							<form id="deleteForm" action="" method="POST">
								<input type="hidden" name="id" value="<?= $item['id'] ?>">
								<input type="submit" name="deleteFormBtn" value="Delete Item">
							</form>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<form id="newItemForm" action="" method="POST">
        <label for="name">Name of new item to track</label><br>
		<input type="text" name="name" required><br>
        <label for="customLink">Custom Wiki Link</label><br>
		<input type="text" name="customLink"><br>
		<input type="submit" name="newItemFormBtn" value="New Item">
	</form>
</div>

<?php include('layout/footer.php') ?>