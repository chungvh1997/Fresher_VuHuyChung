<?php $row_menu_left = getItems("category", "where type like 'post' and enable>0 and parent_id=0	 order by `index`", false) ?>
<?php include _template."layout/breadcrumb.php" ?>
<section id="content" class="category-post">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="post-list list-view row">
				<?php foreach ($row_post as $r_post) { ?>
					<div class="col-md-4 col-xs-12">
						<div class="post-item-container">
							<?php include _template."layout/post-item.php" ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<?php if ($num_post > $limit): ?>
				<div class="text-center">
					<button class="btn readmore-button">
						<span><?= $lang['column_2'] ?></span>
						<span><i class="fa fa-chevron-down"></i></span>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</figure>
</section>