<?php 
	$data = getItems(array("table" => "image","condition" => "where type = 'video'"));
 ?>
<div id="index-video">
	<div class="<?= $container ?>">
		<div class="row index-video-container">
			<div id="index-video-slider" class="swiper-container replaced" data-loop="false" data-margin="20" data-view="1" data-navigation="true" data-speed="1000" data-replay="5000">
				<div>
					<?php foreach ($data as $value):?>
						<div>
							<?= getYoutubeIframe($value['link']);?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
	</div>
</div>