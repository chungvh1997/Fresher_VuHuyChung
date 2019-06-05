<div id="index-top">
	<div class="<?= $container ?>">
		<div class="row index-top-container">
			<!-- <div id="index-top-slider" class="swiper-container replaced" data-loop="false" data-loop-xs="true" data-autoplay="5000" data-speed="1000" -data-touch="false" data-view="3" data-view-sm="3" data-view-xs="1" data-margin-xs="2">
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
			</div> -->
			<div class="top-search">
				<p><?= $lang['column_18'] ?></p>
				<form action="<?=getURL($classify['search'][0]['uri']) ?>" method="post" class="search-top">
					<div class="input-group">
						<label><i class="fa fa-search" aria-hidden="true"></i></label>
						<input type="search" id="inp3" name="q" value="" placeholder="Url">
						<input type="submit" name="search" class="submit hidden">

					</div>
				</form>
			</div>
			<div class="bottom-search col-md-12 col-sm-12 col-xs-12">
				<ul>
					<?php foreach ($layout['index-product'] as $value): ?>
						<li>
							<a href="<?= getURL($value['uri']) ?>">
								<h2><?= $value['title'] ?></h2>
							</a>
						</li>
					<?php endforeach ?>
					
					
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	superplaceholder({
		el: inp3,
		sentences: ['<?=$lang['column_21']?>'],
		options: {
			letterDelay: 80,
			loop: true,
			startOnFocus: false
		}
	})
</script>