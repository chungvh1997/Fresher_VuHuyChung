<?php include _template."layout/breadcrumb.php" ?>
<section id="content" class="category-product">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="product-list grid-view row">
				<?php foreach ($row_product as $r_product): ?>
					<div class="col-md-4 col-xs-12">
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
			<?php include _template."layout/register.php" ?>
		</div>
	</figure>
</section>