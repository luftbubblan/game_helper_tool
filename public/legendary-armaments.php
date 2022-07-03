<?php
	$pageTitle = "LEGENDARY ARMAMENTS";

	require('../src/config.php');
	require('../src/CRUD_functions.php');
	
	if(isset($_POST['acquiredFormBtn'])) {
		$crudFunctions->AcquiredItem($_POST['id']);
	}
	
	if(isset($_POST['newItemFormBtn'])) {
		$crudFunctions->NewItem($_POST['input']);
	}

	if(isset($_POST['deleteFormBtn'])) {
		$crudFunctions->DeleteItem($_POST['id']);
	}
	
	$items = $crudFunctions->fetchAllItems();

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
			<?php foreach($items as $item) { 
				$link = str_replace(' ', '+', $item['itemName']);
				$link = "https://eldenring.wiki.fextralife.com/{$link}";
			?>
				<!-- <?php
				echo "<pre>";
				print_r($item);
				echo "</pre>";
				?> -->
				<tr <?php echo ($item['acquired']==1 ? 'id="acquired"' : 'id="notAcquired"');?>>
					<td>
						<a href="<?= $link ?>" target="_blank"><?= $item['itemName'] ?></a>
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
        <label for="input">Name of new item to track</label><br>
		<input type="text" name="input" required>
		<input type="submit" name="newItemFormBtn" value="New Item">
	</form>
</div>

<?php include('layout/footer.php') ?>