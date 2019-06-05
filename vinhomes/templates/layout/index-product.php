<?php $row_product = getItems(array("table" => "product", "condition" => "where enable>0 and popular>0 order by level desc, create_date>0", "limit" => 6)) ?>
<?php $langwebsite = getItems(array("table" => "website", "condition" => "where language_id = 1 ")) ;
?>
<div id="index-product">
	<div class="<?= $container ?>">
		<div class="row index-product-container">
			<div class="index-title header-section">
				<div class="sub-header">
					<?php foreach ($langwebsite as $value) {
						echo $value['title'];
					} ?></div>
				<h3>
					<?= $lang['column_7'] ?>
				</h3>
			</div>
			<div class="bao-index-product">
				<div id="index-product-slider-<?= $r_index_product['id'] ?>" class="index-product-slider swiper-container replaced" -data-loop="false" data-view="3" data-view-sm="2" data-view-xs="1"   data-fill="row" -data-touch="false" -data-margin="30" data-margin-sm="20" data-margin-xs="15" -data-padding="3" data-navigation=".bao-index-product .swiper-button" style="margin-right: 20px;margin-left: 20px;">
					<div>
						<?php foreach ($row_product as $r_product): ?>
							<div>
								<div class="product-item-container">
									<?php include _template."layout/index-product-item.php" ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="swiper-button-next"><span class="fa fa-chevron-right"></span></div>
				<div class="swiper-button-prev"><span class="fa fa-chevron-left"></span></div>
			</div>
		</div>
	</div>
	<div class="bg-bottom-project ">
		<div class="container">
			<img src="./images/bg-bottom-project.jpg" alt="">
		</div>
	</div>
	<div class="view-all">
		<a href="<?= $layout['index-product'][0]['uri'] ?>" class="hvr-rectangle-out">
			Xem toàn bộ
		</a>
	</div>
</div>