<?php 
$r_category = getItems(array("table" => "category", "condition" => "where id = {$r_post['category_id']}"));
 ?>
<div class="item">
	<a href="<?= getURL($r_post['uri']) ?>">
		<div class="item-heading post-chung">
			<div class="item-title-post-category">
				<?php foreach ($r_category as $category) {
					echo $category['title'];
				} ?>
			</div>
			<p class="ngaygio"><?= str_replace("#","Tháng" , date("j # n, Y",$r_post['create_date']))  ?></p>
			<div class="title-index-post"><?= $r_post['title'] ?></div>
		</div>
		<div class="item-thumbnail post-chung">
			<img src="<?= $r_post['thumbnail'] ?>">
		</div>
		<span class="clearfix"></span>
	</a>
</div>
<script>
	$(document).ready(function(){
		
		setTimeout(() => {
			var max = 0;
			$(".post-chung").each(function(){
				if(max < $(this).outerHeight()){
					max = $(this).outerHeight();
				}
			});
			if(max > 0 ){
				$(".post-chung").css("height",max+"px");
			}
		}, 500);
	})
</script>
