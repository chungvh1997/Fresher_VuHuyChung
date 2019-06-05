<footer id="footer">
	<div class="<?= $container ?>">
		<div class="row footer-container">
			<div id="footer-slider" class="swiper-container replaced" data-view="7" data-column-sm="3" data-column-xs="3" data-touch="false" data-loop="false" data-margin="30" data-margin-sm="20" data-margin-xs="20">
				<div>
					<div data-colspan="3">
						<div class="footer-title"><span><?= $lang['column_10'] ?></span></div>
						<?= $information['information'] ?>
					</div>
					<div data-colspan="2">
						<div class="footer-title"><span><?= $lang['column_11'] ?></span></div>
						<?php foreach ($layout['footer-1'] as $r_menu_footer): ?>
							<div class="footer-item"><a href="<?= getURL($r_menu_footer['uri']) ?>"><?= $r_menu_footer['title'] ?></a></div>
						<?php endforeach ?>
					</div>
					<div data-colspan="2">
						<div class="footer-title"><span><?= $lang['column_12'] ?></span></div>
						<?php foreach ($layout['footer-2'] as $r_menu_footer): ?>
							<div class="footer-item"><a href="<?= getURL($r_menu_footer['uri']) ?>"><?= $r_menu_footer['title'] ?></a></div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<div class="fanpage-container">
				<div class="footer-title"><span><?= $lang['column_14'] ?></span></div>
				<?php include _template."layout/fanpage.php" ?>
			</div>
		</div>
	</div>
</footer>
<div id="copyright">
	<div class="<?= $container ?>">
		<div class="row copyright-container">
			<span><?= $information['copyright'] ?></span>
			<?php $row_social = getItems(array("table" => "image", "condition" => "where type like 'link' and enable>0 order by `index`")) ?>
			<?php if (is_array($row_social) && !empty($row_social)): ?>
				<div class="social-container"><div>
					<?php foreach ($row_social as $r_social): ?>
						<a href="<?= getURL($r_social['link']) ?>" target="_blank"><img src="<?= $r_social['thumbnail'] ?>"></a>
					<?php endforeach ?>
				</div></div>
			<?php endif ?>
		</div>
	</div>
</div>
<div id="maps-modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body"><?= $information['maps'] ?></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$("a[href=\"#maps-modal\"").click(function (e) {
			e.preventDefault();
			$($(this).attr("href")).modal("show");
		});
		$("#maps-modal").on("shown.bs.modal", function () {
			$("#maps-modal iframe").css("height", Math.min($("#maps-modal iframe").outerWidth() * 0.7, $(window).outerHeight() - 100) + "px");
		});
	});
</script>