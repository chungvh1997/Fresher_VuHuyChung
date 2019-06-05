<?php $langwebsite = getItems(array("table" => "website", "condition" => "where language_id = 1 ")) ;
?>
<div id="intro-post">
	<?php 
		$data = getItems(array("table" => "category_image" , "condition" => "where category_id like '{$classify['intro'][0]['id']}' and enable>0 order by `index`"));
	 ?>
	 <div id="intro-swiper" class="swiper-container replaced" data-autoplay="5000" data-speed="1000" data-margin="5">
	 	<div>
	 		<?php foreach ($data as $value): ?>
	 			<div><img src="<?=$value['thumbnail']?>" alt=""></div>
	 		<?php endforeach ?>
	 	</div>
	 </div>
	<div class="<?= $container ?>">
		<div class="row">
			<div class="title-big">
				<?php foreach ($langwebsite as $language) {
					echo $language['title'];
				} ?>
			</div>
			<div class="mota-title">
				<h2 class="full hpnt">
					<span>
						<?=$classify['intro'][0]['description']?>
					</span>
				</h2>
			</div>
			
			<div class="item-happy" id="">
			<?php foreach (array_slice($classify['intro'], 1) as $key => $value): ?>
			<?php 
				$data = getItems(array("table" => "category_image" , "condition" => "where category_id like '{$value['id']}' and enable>0 order by `index`"));
			
	
			 ?>
				<div class="item-left <?=$key%2>0?"right":"" ?>">
					<div id="sub-swiper-<?=$key?>" class="swiper-container replaced" data-autoplay="5000" data-speed="1000" data-margin="5" data-view-xs="1">
				 	<div>
				 		<?php foreach ($data as $va): ?>
				 			<div><img src="<?=$va['thumbnail']?>" alt=""></div>
				 		<?php endforeach ?>
				 	</div>
				 </div>
				</div>

				<div class="item-right <?=$key%2>0?"left":"" ?>">
					<div class="item-title">
						<h2 class="title-full">
							<span>
								<?=$value['title']?>
							</span>
						</h2>
						<div class="description">
							<p style="text-align: justify;">
								<?=$value['description']?>
							</p>
							
						</div>
					</div>
				</div>

			<?php endforeach ?>
			<div class="clearfix"></div>
			</div>

		</div>
	</div>
</div>