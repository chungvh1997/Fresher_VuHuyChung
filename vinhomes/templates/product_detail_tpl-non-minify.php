<?php include _template."layout/breadcrumb.php" ?>
<section id="content" class="product">
	<div class="container">
		<div class="row">
			<div class="content-left">
				<div class="content-box">
					<div id="product-thumbnail" class="swiper-container replaced" data-loop="false" -data-thumbs=".product-navigator" data-touch="0" data-navigation="true" data-margin="5" data-group="<?= min(3, count($row_slide)) ?>" data-group-sm="<?= min(2, count($row_slide)) ?>" data-view="<?= min(3, count($row_slide)) ?>.5" data-view-sm="<?= min(2, count($row_slide)) ?>.5" data-view-xs="1.5" data-center="true" data-autoplay="5000" data-speed="1000">
						<div class="swiper-wrapper">
							<?php foreach ($row_slide as $r_slide) { ?>
								<div class="swiper-slide">
									<a class="various fancybox-thumb" rel="product_detail" href="<?= $r_slide['thumbnail'] ?>"><img src="<?= $r_slide['thumbnail'] ?>"></a>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- <div class="product-navigator swiper-container" data-view="8" data-margin="2" data-cursor="pointer">
						<div class="swiper-wrapper">
							<?php foreach ($row_slide as $r_slide) { ?>
								<div class="swiper-slide"><img src="<?= $r_slide['thumbnail'] ?>"></div>
							<?php } ?>
						</div>
					</div> -->
					<div id="tab-0" class="tab-content">
						<?php if (trim($product['content']) == "" && (!is_array($row_tab) || empty($row_tab))): ?>
							<b class="text-danger" style="font-size: 18px;">Nội dung đang cập nhật!</b>
						<?php endif ?>
						<?= $product['content'] ?>
					</div>
					<?php foreach ($row_tab as $r_tab): ?>
						<div id="tab-<?= $r_tab['id'] ?>" class="tab-content">
							<?= $r_tab['content'] ?>
						</div>
					<?php endforeach ?>
					<?php include _template."layout/addthis.php" ?>
					<?php include _template."layout/register.php" ?>
				</div>
			</div>
			<div class="content-right"><?php include _template."layout/menu-right.php" ?></div>
			<div class="content-navigation">
				<span data-href="#tab-0" title="<?= $lang['column_18'] ?>">
					<?= $lang['column_18'] ?>
					<img src="<?= $design['product-navigation-img']['thumbnail'] ?>">
				</span>
				<?php foreach ($row_tab as $r_tab): ?>
					<span data-href="#tab-<?= $r_tab['id'] ?>" title="<?= $r_tab['title'] ?>">
						<?= $r_tab['title'] ?>
						<img src="<?= $r_tab['thumbnail'] ?>">
					</span>
				<?php endforeach ?>
			</div>
		</div>
		<div class="row">
			<div class="index-title"><?= $lang['column_17'] ?></div>
			<div class="product-list grid-view row">
				<?php foreach ($row_related as $r_product): ?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="product-item-container">
							<?php include _template."layout/product-item.php" ?>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="clearfix"></div>
			<?php if ($num_product > $limit): ?>
				<div class="text-center">
					<button class="btn readmore-button">
						<span><?= $lang['column_15'] ?></span>
						<span><i class="fa fa-chevron-down"></i></span>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>