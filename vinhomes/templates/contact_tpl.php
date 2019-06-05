<div id="content-product-img">
	<div id="product-thumbnail" class="swiper-container replaced" data-loop="false" data-touch="false" data-view="1">
		<div class="swiper-wrapper">
				<div class="swiper-slide">
					<img src="<?= $category['thumbnail'] ?>">
				</div>
		</div>
	</div>
</div>
<section id="content" class="contact">
	<figure class="<?= $container ?> contaction" >
		<h1 class="title-before">Thông tin liên hệ</h1>
		<div class="row contact-info-lon">
			<?php foreach ($classify['product'] as $r_cat): ?>
			<div class="contact-info ">
				<?php 
					$getSP = getItems(array("table" => "product", "condition" => "where category_id = {$r_cat['id']}"));
				 ?>
				<h2 class="title-type-bds"><?= $r_cat['title'] ?></h2>
				<div class="select-contact">
					<select class="slbProject" data-target=".info-detail-<?=$r_cat['id']?>">
						<?php foreach ($getSP as $getItemSP): ?>
							<option value="<?= $getItemSP['id'] ?>"><?= $getItemSP['title'] ?></option>
						<?php endforeach ?>
						
                      
					</select>
					<span class="before-select"></span>
				</div>
				<h3 class="title-item-product"><?= $getItemSP['title'] ?></h3>
				<div class="list-show-contact">
					<?php foreach ($getSP as $k => $getItemSP): ?>
					<div class="info-detail info-detail-<?=$r_cat['id']?> <?= $k==0?"active":"" ?> n-<?=$getItemSP['id'] ?>">
						<h3>
							<?= $getItemSP['first_tag']?$getItemSP['first_tag']:$getItemSP['second_tag'] ?>
						</h3>
					</div>
					<?php endforeach ?>
					
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="row contact-container">
			<div class="contact-left">
				<div class="contact-body"><?= $category['content'] ?></div>
				<?php include _template."layout/register.php" ?>
			</div>
			<div class="contact-right">
				<?= $information['maps'] ?>
			</div>
		</div>
	</figure>
</section>
<script>
	$(document).ready(function() {
		$("form.contact-form").submit(() => {
			response = grecaptcha.getResponse();
			if (response == "") {
				if (!$(".g-recaptcha").hasClass("error"))
					$(".g-recaptcha").addClass("error");
				return false;
			} else
				return true;
			return false;
		});
		$(window).resize(function() {
			setTimeout(function() {
				if (window.matchMedia("(max-width: 767px)").matches)
					$(".map-container").css("height", ($(".map-container").outerWidth() * 0.6) + "px");
				else
					$(".map-container").css("height", $(".map-container").prev().outerHeight() + "px");
			}, 500);
		});
	});

	function gcallback() {
		$(".g-recaptcha").removeClass("error");
	}
</script>
<style>
	#content .g-recaptcha {
		display: inline-block;
    padding: 5px;
    margin-left: 3px;
    -webkit-transition: box-shadow .5s;
    -o-transition: box-shadow .5s;
    transition: box-shadow .5s;
	}
	#content .g-recaptcha.error {
		box-shadow: 0 0 5px #c64848;
	}

	.info-detail{
		display: none;
	}
	.info-detail.active{
		display: block;
	}
</style>
<script>
	$(document).ready(function() {
		$(".slbProject").change(function(){
			var value = $(this).val();

			var target = $(this).data('target');
			console.log($(target+".n-"+value));
			$(target).removeClass('active');
			$(target+".n-"+value).addClass('active');
		});	

	});
</script>