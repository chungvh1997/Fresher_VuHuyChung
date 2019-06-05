<?php 
	//var_dump($row_post);
	$first_post = $row_post[0];

	$row_post = array_slice($row_post, 1);	
?>
<section id="content" class="category-post">
	<figure class="<?= $container ?>">
		<div class="row">
			<div class="content-left">
				<?php if (is_array($first_post) && !empty($first_post)) { ?>
					<div class="content-box-cty" style="    margin-top: 30px;">
						<div class="title-section-ttdt">
							<a href="">
								<h2 class="title-before">
									<?= $category['title'] ?>
								</h2>
							</a>
						</div>
						<div class="clearfix"></div>
						<div>
							<div id="post-thumbnail" class="swiper-container replaced" data-loop="false" data-touch="false" data-view="1" >
								<div>
									<div class="swiper-slide">
										<div class="item-post-first">
											<a href="" class="first-post-thumbnail"><img src="<?= $first_post['thumbnail'] ?>" alt=""></a>
											<div class="first-right">
												<p class="date-post-first">
													<?= str_replace("#","Tháng" , date("j # n, Y",$first_post['create_date'])) ?>
												</p>
												<h2 class="title-post-first"><a href="<?=$first_post['uri'] ?>"><?= $first_post['title'] ?></a></h2>
												<div class="except-post"><?= $first_post['description'] ?></div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						
							
						<div class="post-list" style="padding: 15px;padding-top: 30px;">
							<?php foreach ($row_post as $key => $value) {  ?>
								<div class="col-md-4 col-xs-12">
									<?php include _template."layout/item-post-all.php" ?>
								</div>	
							<?php } ?>	
						</div>	
						<div class="clearfix"></div>
					</div>

				<?php } ?>
				
				

			</div>
			<div class="content-right">
				<?php include _template."layout/menu-right.php" ?>
			</div>
			
		</div>
	</figure>
</section>