<?php 
$r_category = getItems(array("table" => "category", "condition" => "where id = {$r_product['category_id']}"));

 ?>

<div class="product-item">
	<a href="<?= getURL($r_product['uri']) ?>">
		<div class="item-thumbnail"><img src="<?= $r_product['thumbnail'] ?>"></div>
		<div class="title-category-index-product-item"><?php foreach ($r_category as $category) {
			echo $category['title'];
		} ?>
		</div>
		<div class="title-index-product-item"><?= $r_product['title'] ?></div>
		
	</a>
</div>