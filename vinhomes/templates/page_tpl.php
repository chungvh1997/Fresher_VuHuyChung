<section id="content" class="category-page">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
				<div class="content-box-cty" style="    margin-top: 30px;">
					<div class="title-section-ttdt">
						<h2 class="title-before">
							<?= $category['title'] ?>
						</h2>
					</div>
					<div class="clearfix"></div>
					<div class="content-csbh">
						<?php
							$row_tab = getItems(array("table" => "category_tab", "condition" => "where category_id = {$category['id']} and enable>0 order by `index`"));
						 ?>	
						<ul>
							<?php foreach ($row_tab as $value): ?>
								<li>
									<h3><?= $value['title'] ?></h3>
									<span><?= $value['content'] ?></span>
								</li>
							<?php endforeach ?>
						</ul>
					</div>
					<div class="clearfix" style="padding-bottom: 20px;"></div>
				</div>

				<?php //include _template."layout/comment.php" ?>
			</div>
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
		</div>
	</figure>
</section>
<style>
	.category-page .content-sukien{display: none;}
	.category-page .content-noibat{margin-top: unset;}
</style>