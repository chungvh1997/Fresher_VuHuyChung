<?php include _template."layout/breadcrumb.php" ?>
<section id="content" class="post">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
				<div class="content-box">
					<div class="post-body"><?= $post['content'] ?></div>
					<?php include _template."layout/addthis.php" ?>
					<?php include _template."layout/register.php" ?>
					<div class="description-title related-title category-title"><?= $lang['column_16'] ?></div>
					<div class="post-related">
						<?php foreach ($row_relative_cat as $r_post): ?>
							<div><a href="<?= getURL($r_post['uri']) ?>" class="related-item">
								<span class="fa fa-circle"></span><?= $r_post['title'] ?>
							</a></div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
		</div>
	</figure>
</section>