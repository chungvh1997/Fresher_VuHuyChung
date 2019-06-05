<?php 
	$category_id = getItems(array("table" => "category", "condition" => "where uri = 'su-kien'"));
	foreach ($category_id as $r_category_id) {	
	}	
	$event = getItems(array("table" => "post" , "condition" => "where category_id = {$r_category_id['id']}"));
 ?>
<div id="project-sukien">
	<div class="<?= $container ?>">
		<div class="row">
			<div class="col-12">
				<div class="product-sukien-container">
					<?php foreach ($event as $r_event): ?>
						<?php include _template."layout/item_sukien.php" ?>
					<?php endforeach ?>
					
				</div>
			</div>
		</div>
	</div>
</div>