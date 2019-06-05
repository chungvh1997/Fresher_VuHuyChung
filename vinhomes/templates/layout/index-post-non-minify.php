<?php $row_post = getItems(array("table" => "post", "condition" => "where enable>0 and popular>0 order by level desc, create_date>0", "limit" => 5)) ?>
<div id="index-post">
	<div class="<?= $container ?>">
		<div class="row index-post-container">
			<div class="index-title"><?= $lang['column_9'] ?></div>
			<div id="index-post-slider" class="swiper-container replaced" data-loop="false" data-view="2" data-view-sm="2" data-column-xs="2" data-fill="row" data-touch="false" data-margin="10" data-padding="3">
				<div>
					<div>
						<div id="index-post-left-slider" class="swiper-container replaced" data-loop="false" data-touch="false" data-padding="3">
							<div>
								<div class="post-item-container">
									<?php $r_post = $row_post[0]; include _template."layout/post-item.php" ?>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div id="index-post-right-slider" class="swiper-container replaced" data-loop="false" data-touch="false" data-margin="10" data-padding="3" data-column="4" data-column-sm="4" data-column-xs="4">
							<div>
								<?php foreach ($row_post as $k_post => $r_post): if($k_post == 0) continue; ?>
									<div class="post-item-container">
										<?php include _template."layout/post-item.php" ?>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>