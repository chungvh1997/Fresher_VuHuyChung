<div id="index-top">
	<div class="<?= $container ?>">
		<div class="row index-top-container">
			<div id="index-top-slider" class="swiper-container replaced" data-loop="false" data-loop-xs="true" data-autoplay="5000" data-speed="1000" -data-touch="false" data-view="3" data-view-sm="3" data-view-xs="1" data-margin-xs="2">
				<div>
					<?php foreach ($layout['index-top'] as $r_index_top): ?>
						<div class="item">
							<a href="<?= getURL($r_index_top['uri']) ?>">
								<div class="item-title text-center"><?= $r_index_top['title'] ?></div>
								<img class="item-thumbnail" src="<?= $r_index_top['thumbnail'] ?>">
								<div class="item-description text-center"><?= $r_index_top['description'] ?></div>
							</a>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>