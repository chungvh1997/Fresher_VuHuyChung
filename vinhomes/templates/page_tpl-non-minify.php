<?php include _template."layout/breadcrumb.php" ?>
<section id="content" class="category-page">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
				<div class="content-box">
					<div class="content-title"><?= $category['first_tag'] ?></div>
					<div class="content-body"><?= $category['content'] ?></div>
					<?php include _template."layout/addthis.php" ?>
					<?php include _template."layout/register.php" ?>
				</div>
				<?php //include _template."layout/comment.php" ?>
			</div>
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
		</div>
	</figure>
</section>