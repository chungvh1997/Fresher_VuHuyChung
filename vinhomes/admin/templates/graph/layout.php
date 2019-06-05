<div id="layout-parent-slider-<?= $r_language['uri'] ?>" class="swiper-container replaced" data-loop="false" data-column="6" data-column-sm="6" data-column-xs="6" data-margin="10" data-touch="false" data-overflow="visible">
	<div>
		<div>
			<?= getGraph($row_position['layout-top']) ?>
		</div>
		<div>
			<?= getGraph($row_position['layout-center']) ?>
		</div>
		<div>
			<?= getGraph($row_position['layout-index-top']) ?>
		</div>
		<div>
			<?= getGraph($row_position['layout-index-product']) ?>
		</div>
		<div class="well">
			Nội dung
		</div>
		<div>
			<div id="layout-footer-slider" class="swiper-container replaced" data-loop="false" data-view="2" data-view-sm="2" data-view-xs="2" data-margin="10" data-touch="false" data-overflow="visible">
				<div>
					<div>
						<?= getGraph($row_position['layout-footer-left']) ?>
					</div>
					<div>
						<?= getGraph($row_position['layout-footer-right']) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>