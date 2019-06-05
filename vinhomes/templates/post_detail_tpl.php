<?php 
	$data_post = getItems(array("table" => "post","condition" => "where popular > 0 limit 0,3"));
 ?>
<section id="content" class="post">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
				<div class="content-box">
					<h1 class="title-ttdt"><?=$post['title'] ?></h1>
					<p class="date-post"><?= str_replace("#","Tháng" , date("j # n, Y",$post['create_date'])) ?></p>
					<div class="post-body"><?= $post['content'] ?></div>
					<!-- <?php include _template."layout/addthis.php" ?> -->
					<!-- <?php include _template."layout/register.php" ?> -->
					<div class="description-title related-title category-title"><?= $lang['column_16'] ?></div>
					<div class="post-related">
						<?php foreach ($row_relative_cat as $r_post): ?>
							<div><a href="<?= getURL($r_post['uri']) ?>" class="related-item">
								<span class="fa fa-circle"></span><?= $r_post['title'] ?>
							</a></div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="content-bottom">
					<h2 class="title-before">Cùng chuyên mục</h2>
					<div>
						<div id="cungchuyenmuc-slider" class="swiper-container replaced" data-loop="false" data-touch="false"  data-view="3"  >
							<div>
								<?php foreach ($data_post as $post_relative): ?>
									<div class="item-cungchuyenmuc">
										<div class="item-chuyenmuc">
											<img src="<?=$post_relative['thumbnail'] ?>" alt="">
											<h3><a href="<?=getURL($post_relative['uri'])  ?>"><?= $post_relative['title'] ?></a></h3>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
		</div>
	</figure>
</section>