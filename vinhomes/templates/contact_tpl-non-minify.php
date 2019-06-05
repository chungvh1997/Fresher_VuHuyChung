<?php include _template."layout/breadcrumb.php" ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section id="content" class="contact">
	<figure class="<?= $container ?>">
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
</style>