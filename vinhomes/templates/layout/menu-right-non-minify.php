<?php
$row_featured = array(
	"product" => getItems(array("table" => "product", "condition" => "where enable>0 and popular>0 order by level desc, create_date desc", "limit" => 8)),
	"post" => getItems(array("table" => "post", "condition" => "where enable>0 and popular>0 order by level desc, create_date desc", "limit" => 8)),
)
?>
<div id="menu-right">
	<?php if (is_array($design['right-hotline']) && !empty($design['right-hotline'])): ?>
		<a href="<?= $design['right-hotline']['link'] ?>" class="hotline"><img src="<?= $design['right-hotline']['thumbnail'] ?>"></a>
	<?php endif ?>
	<div class="line"></div>
	<div class="menu-title"><?= $lang['column_7'] ?></div>
	<div class="featured-product">
		<?php foreach ($row_featured['product'] as $r_featured): ?>
			<a href="<?= getURL($r_featured['uri']) ?>" class="item"><span class="fa fa-caret-right"></span><?= $r_featured['title'] ?></a>
			<div class="clearfix featured-product-line"></div>
		<?php endforeach ?>
	</div>
	<div class="line"></div>
	<?php if (is_array($design['right-adv-1']) && !empty($design['right-adv-1'])): ?>
		<div class="menu-adv"><a href="<?= $design['right-adv-1']['link'] ?>"><img src="<?= $design['right-adv-1']['thumbnail'] ?>"></a></div>
	<?php endif ?>
	<div class="line"></div>
	<div class="menu-title"><?= $lang['column_8'] ?></div>
	<div class="menu-video">
		<?= $design['right-video']['iframe'] ?>
	</div>
	<div class="line"></div>
	<?php if (is_array($design['right-adv-2']) && !empty($design['right-adv-2'])): ?>
		<div class="menu-adv"><a href="<?= $design['right-adv-2']['link'] ?>"><img src="<?= $design['right-adv-2']['thumbnail'] ?>"></a></div>
	<?php endif ?>
	<div class="line"></div>
	<div class="featured-container">
		<div class="menu-title"><?= $lang['column_9'] ?></div>
		<div class="featured-post">
			<?php foreach ($row_featured['post'] as $r_featured): ?>
				<div class="item">
					<a href="<?= getURL($r_featured['uri']) ?>">
						<img class="item-thumbnail" src="<?= $r_featured['thumbnail'] ?>" alt="<?= $r_featured['title'] ?>">
						<div class="item-body"><?= $r_featured['title'] ?></div>
					</a>
				</div>
				<div class="clearfix featured-post-line"></div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="line"></div>
	<?php if (is_array($design['right-adv-3']) && !empty($design['right-adv-3'])): ?>
		<div class="menu-adv"><a href="<?= $design['right-adv-3']['link'] ?>"><img src="<?= $design['right-adv-3']['thumbnail'] ?>"></a></div>
	<?php endif ?>
</div>