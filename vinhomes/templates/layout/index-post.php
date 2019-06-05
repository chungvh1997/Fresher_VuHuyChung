<?php $row_post = getItems(array("table" => "post", "condition" => "where enable>0 and popular>0 order by level desc, create_date>0", "limit" => 4));
?>
<?php $langwebsite = getItems(array("table" => "website", "condition" => "where language_id = 1 ")) ;
?>
<div id="index-post">
	<div class="<?= $container ?>">
		<div class="row index-post-container">
			<div class="index-title header-section">
				<div class="sub-header">
					<?php foreach ($langwebsite as $value) {
						echo $value['title'];
					} ?>
				</div>
				<h3>
					 <?= $classify['tintuc'][0]['title']?>
				</h3>
			</div>
			<div>
				<div id="index-post-right-slider" class="swiper-container replaced" data-loop="false" data-touch="false" data-margin="20" data-view="2" data-view-sm="2" data-padding="4" data-column="2" data-column-sm="2" data-column-xs="2">
					<div>
						<?php foreach ($row_post as $k_post => $r_post): ?>
							<div class="post-item-container">
								<?php include _template."layout/post-item.php" ?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		<div class="view-all">
		<a href="<?= $classify['tintuc'][0]['uri'] ?>" class="hvr-rectangle-out">
			Xem toàn bộ
		</a>
	</div>
	</div>
</div>