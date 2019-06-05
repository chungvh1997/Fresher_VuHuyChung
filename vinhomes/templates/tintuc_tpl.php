
<section id="content" class="category-post">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
			<?php foreach ($getCategory as $getCate): ?>
				<div class="content-box-cty">
					<div class="title-section-ttdt">
						<a href="">
							<h2 class="title-before">
									<?= $getCate['title'] ?>
							</h2>
						</a>
						<a href="<?= getURL($getCate['uri']) ?>" class="view-all-post">
							<i class="fa fa-th"></i>
							Xem tất cả 	
						</a>
					</div>
					<div class="clearfix"></div>
					<div class="ttdt-item">
						<div id="post-thumbnail" class="swiper-container replaced" data-loop="false" data-touch="false" data-view="3" data-view-sm="3" data-margin="20">
							<div>
									<?php $getPost = getItems(array("table" => "post","condition" => "where category_id = {$getCate['id']}")); ?>
									<?php foreach ($getPost as $getPostItem): ?>
										<div class="swiper-slide">
											<?php include _template."layout/item-post-tt.php" ?>
										</div>
									<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			</div>
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
			
		</div>
	</figure>
</section>
<style>
	.content-left{margin-top: 30px;}
</style>