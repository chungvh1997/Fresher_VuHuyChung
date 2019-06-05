<!-- <div id="index-product">
	<div class="<?= $container ?>">
		<?php foreach ($layout['index-product'] as $r_index_product): ?>
			<?php $row_product = getItems(array("table" => "product", "condition" => "where category_id like '{$r_index_product['id']}' and enable>0 and popular>0 order by level desc, create_date>0", "limit" => 6)) ?>
			<div class="row index-product-container">
				<div class="index-title"><?= $r_index_product['title'] ?> <?= $lang['column_7'] ?></div>
				<div id="index-product-slider-<?= $r_index_product['id'] ?>" class="index-product-slider swiper-container replaced" data-loop="false" data-view="3" data-view-sm="2" data-view-xs="1" data-column="2" data-column-sm="3" data-column-xs="6" data-fill="row" data-touch="false" data-margin="30" data-margin-sm="20" data-margin-xs="15" data-padding="3">
					<div>
						<?php foreach ($row_product as $r_product): ?>
							<div>
								<div class="product-item-container">
									<?php include _template."layout/product-item.php" ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div> -->

<?php $row_product = getItems(array("table" => "product", "condition" => "where enable>0 and popular>0 order by level desc, create_date>0", "limit" => 6)) ?>
<div id="index-product">
	<div class="<?= $container ?>">
		<div class="row index-product-container">
			<div class="index-title"><?= $r_index_product['title'] ?> <?= $lang['column_7'] ?></div>
			<div id="index-product-slider-<?= $r_index_product['id'] ?>" class="index-product-slider swiper-container replaced" data-loop="false" data-view="3" data-view-sm="2" data-view-xs="1" data-column="2" data-column-sm="3" data-column-xs="6" data-fill="row" data-touch="false" data-margin="30" data-margin-sm="20" data-margin-xs="15" data-padding="3">
				<div>
					<?php foreach ($row_product as $r_product): ?>
						<div>
							<div class="product-item-container">
								<?php include _template."layout/product-item.php" ?>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>