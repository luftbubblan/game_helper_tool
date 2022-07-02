<?php
	$pageTitle = "Home";

	require('../src/config.php');
	require('../src/CRUD_functions.php');

	
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	
	if(isset($_POST['acquiredFormBtn'])) {
		$crudFunctions->Acquired($_POST['id']);
		// header('Location: '.$_SERVER['REQUEST_URI']);
	}
	
	if(isset($_POST['newItemFormBtn'])) {
		$crudFunctions->NewItem($_POST['input']);
		// header('Location: '.$_SERVER['REQUEST_URI']);
	}
	
	$items = $crudFunctions->fetchAllItems();
	
	// echo "<pre>";
	// print_r($items);
	// echo "</pre>";

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
				<tr <?php echo ($item['acquired']==1 ? 'id="acquired"' : 'id="notAcquired"');?>>
					<td>
						<?= $item['name'] ?>
					</td>
					<td>
						<a href="<?= $item['link'] ?>" target="_blank"><?= $item['link'] ?></a>
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
		<input type="text" name="input" placeholder="Name of item" required>
		<input type="submit" name="newItemFormBtn" value="New Item">
	</form>
</div>

<?php include('layout/footer.php') ?>