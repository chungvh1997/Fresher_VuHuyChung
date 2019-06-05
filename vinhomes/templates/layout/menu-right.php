<?php 
	$data_category = getItems(array("table" => "category" ,"condition" => "where uri ='su-kien'"));
	foreach ($data_category as $key => $value) {
		$category_id=$value['id'];
	}
	
	$data = getItems(array("table" => "post", "condition" => "where category_id = {$category_id} limit 0,4"));
	//var_dump($data);
	$data_img = getItems(array("table" => "image", "condition" => "where type = 'popular'"));
	//var_dump($data_img);
 ?>
<div id="menu-right">
	<div class="content-sukien">
		<h2 class="title-before"><?= $lang['column_19'] ?></h2>
		<ul class="list-su-kien">
			<?php foreach ($data as $event): ?>

			<li>
				<a href="">
					<p class="date-post-su-kien">
						<?= str_replace("#","Tháng" , date("d # m",$data['create_date'])) ?>
					</p>
					<h3 class="title-event">
						<a href="<?= getURL($event['uri']) ?>">
							<?= $event['title'] ?>
						</a>
					</h3>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
		<a href="<?= getURL($classify['sukien'][0]['uri']) ?>" class="all-view">
			<span>Xem tất cả</span>
		</a>
	</div>
	<div class="content-noibat">
		<h2 class="title-before"><?= $lang['column_20'] ?></h2>
		<?php foreach ($data_img as $val_img): ?>
			<a href=""><img src="<?= $val_img['thumbnail'] ?>" alt=""></a>
		<?php endforeach ?>
		
	</div>
</div>