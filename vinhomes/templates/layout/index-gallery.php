<?php $langwebsite = getItems(array("table" => "website", "condition" => "where language_id = 1 ")) ;
?>
<div id="index-gallery">
	<div class="<?= $container ?>">
		<div class="row index-gallery-container">
			<div class="index-title header-section">
				<div class="sub-header">
					<?php foreach ($langwebsite as $value) {
						echo $value['title'];
					} ?></div>
				<h3>
					<?= $lang['column_26'] ?>
				</h3>
			</div>
			<div>
				<div id="index-gallery-slider" class="swiper-container replaced" data-loop="false" -data-touch="false" data-margin="20" data-view="3" data-view-sm="3" data-column-sm="2" data-navigation="true"  data-padding="4" data-column="2" data-column-sm="2" >
					<div>
						<?php foreach ($layout['index-top'] as $k_post => $r_post): ?>
							<div>
								<div class="gallery-item-container">
									<?php include _template."layout/gallery-item.php" ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>