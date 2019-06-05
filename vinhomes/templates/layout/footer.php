<footer id="footer">
	<div class="<?= $container ?>">
		<div class="row footer-container">
			<div id="footer-slider" class="swiper-container replaced" data-view="8" data-view-xs="1" data-column-xs="4" data-touch="false" data-loop="false" data-margin="30" data-margin-sm="20" data-margin-xs="20">
				<div >
					<div data-colspan="2.5" >
						<?= $information['information'] ?>
					</div>
					<div data-colspan="4">
						
								<div style="width:calc(50% - 15px / 2) ;float: left;">
									<div class="footer-title"><span><?= $lang['column_11'] ?></span></div>
									<?php foreach ($layout['footer-1'] as $r_menu_footer): ?>
										<div class="footer-item"><a href="<?= getURL($r_menu_footer['uri']) ?>"><?= $r_menu_footer['title'] ?></a></div>
									<?php endforeach ?>
								</div>
								<div style="width: calc(50% - 15px / 2);float: right;">
									<div class="footer-title"><span><?= $lang['column_12'] ?></span></div>
									<?php foreach ($layout['footer-2'] as $r_menu_footer): ?>
										<div class="footer-item"><a href="<?= getURL($r_menu_footer['uri']) ?>"><?= $r_menu_footer['title'] ?></a></div>
									<?php endforeach ?>
								</div>
						


					</div>
				
					<div data-colspan="1.5" class="lienket">
						<div class="footer-title"><span><?= $lang['column_14'] ?></span></div>
						<?php 
							$data = getItems(array("table" => "image","condition" => "where type = 'link' and enable > '0'"));
						 ?>
						<?php foreach ($data as $value):?>
							<div class="footer-item">
								<a href="<?=$value['link']?>">
									<img src="<?=$value['thumbnail']?>" alt="">
								
									<span><?=$value['title']?></span>
								</a>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<div class="form-dky-nhanbantin">
				<!-- <div class="footer-title"><span><?= $lang['column_14'] ?></span></div>
				<?php include _template."layout/fanpage.php" ?> -->
				<div class="footer-title"><span>ĐĂNG KÝ NHẬN BẢN TIN</span></div>
				<p class="sub-title">Xin vui lòng để lại địa chỉ email, chúng tôi sẽ cập nhật những tin tức quan trọng của Vinhomes tới quý khách</p>	
				<form action="" method="">
					<input type="email" required name="email" class="email" placeholder="Nhập email của bạn">
					<button class="btn btn-default" id="filterData" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Đang lưu">→</button>
				</form>
			</div>
		</div>
	</div>
</footer>
<?php $row_language = getItems(array("table" => "language", "condition" => "where  enable>0 ")) ?>
<div id="copyright">
	<div class="<?= $container ?>">
		<div class="row copyright-container">
			<div class="social-container visible-xs">
					<div>
						<div style="display: grid;justify-content: center;">
							<div style="font-size: 18px;">Chọn ngôn ngữ:</div>
							<?php foreach ($row_language as $value) { ?>
								<div style="display: grid;justify-content: center;margin-top: 10px;">
									<a href="<?= getURL($value['uri'],false,false) ?>" title="<?= $value['title'] ?>"><img src="<?=$value['thumbnail']?>" alt="">
									</a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<span><?= $information['copyright'] ?></span>
			
			<div class="social-container hidden-xs">
					<div>
						<ul>
							<li>Chọn ngôn ngữ:</li>
							<?php foreach ($row_language as $value) { ?>
								<li><a href="<?= getURL($value['uri'],false,false) ?>" ><img src="<?=$value['thumbnail']?>" alt=""></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				
			
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