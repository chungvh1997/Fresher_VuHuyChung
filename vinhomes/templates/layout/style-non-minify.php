<?php $design = getLayout("design") ?>
<style>
	<?php if ($design['body-bg'] != ""): ?>
		body {
			background-color: <?= $design['body-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['body-ff'] != ""): ?>
		body {
			color: <?= $design['body-ff'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['body-fg'] != ""): ?>
		body a {
			color: <?= $design['body-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['body-fv'] != ""): ?>
		body a:hover {
			color: <?= $design['body-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-title-fg'] != ""): ?>
		#content .index-title,
		#content .content-title {
			color: <?= $design['index-title-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-title-line'] != ""): ?>
		#content .index-title {
			background: url('<?= $design['index-title-line']['thumbnail'] ?>') bottom center no-repeat;
		}
	<?php endif; ?>
	<?php if ($design['top-bg'] != ""): ?>
		#menu-top {
			background: <?= $design['top-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['top-fg'] != ""): ?>
		#menu-top * {
			color: <?= $design['top-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['top-fv'] != ""): ?>
		#menu-top a:hover {
			color: <?= $design['top-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['banner-bg'] != ""): ?>
		.swiper-pagination span,
		#banner,
		#menu-center:after {
			background: <?= $design['banner-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv1-bg'] != ""): ?>
		.swiper-pagination span.swiper-pagination-bullet-active,
		.swiper-pagination span:hover,
		#menu-mobile .menu-mobile-navigation,
		#menu-mobile-container,
		#menu-center .menu-container {
			background: <?= $design['center-lv1-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv1-bv'] != ""): ?>
		#menu-mobile .menu-mobile-navigation a.btn:hover,
		#menu-mobile-container a:hover,
		#menu-center .item:hover > a {
			background: <?= $design['center-lv1-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv1-fg'] != ""): ?>
		#menu-mobile-container {
			border-right: solid 1px <?= $design['center-lv1-fg'] ?>;
		}
		.mm-menu .mm-listview > li .mm-prev:after,
		.mm-menu .mm-listview > li .mm-next:before,
		.mm-menu .mm-listview > li .mm-prev:before,
		.mm-menu .mm-listview > li .mm-arrow:after,
		.mm-menu .mm-listview > li:after,
		.mm-menu .mm-navbar .mm-btn:after,
		.mm-menu .mm-navbar {
			border-color: rgba(<?= hexdec(substr($design['center-lv1-fg'], 1, 2)) ?>, <?= hexdec(substr($design['center-lv1-fg'], 3, 2)) ?>, <?= hexdec(substr($design['center-lv1-fg'], 5, 2)) ?>, .2);
		}
		.mm-menu .mm-navbar .mm-btn:before,
		.mm-menu .mm-listview > li .mm-next:after,
		#menu-mobile .menu-mobile-navigation a.btn {
			border-color: <?= $design['center-lv1-fg'] ?>;
		}
		#menu-mobile .menu-mobile-navigation .slogan,
		#menu-mobile .menu-mobile-navigation a.btn,
		#menu-mobile-container a,
		#menu-center .item > a {
			color: <?= $design['center-lv1-fg'] ?>;
		}
		#menu-center .line-vertical {
			background: linear-gradient(to bottom, transparent, <?= $design['center-lv1-fg'] ?>, transparent);
		}
	<?php endif; ?>
	<?php if ($design['center-lv1-fv'] != ""): ?>
		#menu-mobile .menu-mobile-navigation a.btn:hover,
		#menu-mobile-container a:hover,
		#menu-center .item:hover > a {
			color: <?= $design['center-lv1-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv2-bg'] != ""): ?>
		#menu-center .menu-subcontainer,
		#menu-center .menu-subcontainer .subitem > a {
			background: <?= $design['center-lv2-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv2-bv'] != ""): ?>
		#menu-center .menu-subcontainer .subitem:hover > a {
			background: <?= $design['center-lv2-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['center-lv2-fg'] != ""): ?>
		#menu-center .menu-subcontainer .subitem > a {
			color: <?= $design['center-lv2-fg'] ?>;
		}
		#menu-center .subitem:not(:last-child) > a {
			border-bottom: dotted 1px rgba(<?= hexdec(substr($design['center-lv2-fg'], 1, 2)) ?>, <?= hexdec(substr($design['center-lv2-fg'], 3, 2)) ?>, <?= hexdec(substr($design['center-lv2-fg'], 5, 2)) ?>, .5);
		}
	<?php endif; ?>
	<?php if ($design['center-lv2-fv'] != ""): ?>
		#menu-center .menu-subcontainer .subitem:hover > a {
			color: <?= $design['center-lv2-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['breadcrumb-ff'] != ""): ?>
		.breadcrumb>li+li:before,
		.breadcrumb>.active {
			color: <?= $design['breadcrumb-ff'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['breadcrumb-fg'] != ""): ?>
		.breadcrumb>li>a {
			color: <?= $design['breadcrumb-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['breadcrumb-fv'] != ""): ?>
		.breadcrumb>li>a:hover {
			color: <?= $design['breadcrumb-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['content-bg'] != ""): ?>
		.contact-container,
		#content .content-box {
			background: <?= $design['content-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['content-br'] != ""): ?>
		.contact-container,
		#content .content-box {
			border: solid 1px <?= $design['content-br'] ?>;
		}
		#menu-right .featured-product .featured-product-line {
			border-bottom: solid 1px <?= $design['content-br'] ?>;
		}
		#menu-right .featured-post .featured-post-line {
			border-bottom: dotted 1px <?= $design['content-br'] ?>;
		}
		#menu-right .featured-container,
		#menu-right .menu-adv:after {
			border: solid 1px <?= $design['content-br'] ?>;
		}
		#menu-right .menu-adv:hover:after {
			box-shadow: 0 0 3px <?= $design['content-br'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-form-bg'] != ""): ?>
		#content .register-form {
			background: <?= $design['register-form-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-form-br'] != ""): ?>
		#content .register-form {
			border-color: <?= $design['register-form-br'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-button-bg'] != ""): ?>
		#content .register-form .btn {
			background: <?= $design['register-button-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-button-bv'] != ""): ?>
		#content .register-form .btn:hover {
			background: <?= $design['register-button-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-button-fg'] != ""): ?>
		#content .register-form .btn {
			color: <?= $design['register-button-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['register-button-fv'] != ""): ?>
		#content .register-form .btn:hover {
			color: <?= $design['register-button-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-title-bg'] != ""): ?>
		#menu-right .menu-title {
			background: <?= $design['right-title-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-title-fg'] != ""): ?>
		#menu-right .menu-title {
			color: <?= $design['right-title-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-product-bg'] != ""): ?>
		#menu-right .featured-product .item {
			background: <?= $design['right-product-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-product-bv'] != ""): ?>
		#menu-right .featured-product .item:hover {
			background: <?= $design['right-product-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-product-fg'] != ""): ?>
		#menu-right .featured-product .item {
			color: <?= $design['right-product-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-product-fv'] != ""): ?>
		#menu-right .featured-product .item:hover {
			color: <?= $design['right-product-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-post-bg'] != ""): ?>
		#menu-right .featured-post {
			background: <?= $design['right-post-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-post-fg'] != ""): ?>
		#menu-right .featured-post .item-body {
			color: <?= $design['right-post-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['right-post-fv'] != ""): ?>
		#menu-right .featured-post .item-body:hover {
			color: <?= $design['right-post-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['footer-bg'] != ""): ?>
		#footer {
			background: <?= $design['footer-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['footer-ff'] != ""): ?>
		#footer .footer-title:not(.none-bordered):before {
			background: <?= $design['footer-ff'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['footer-fg'] != ""): ?>
		#footer .footer-title:not(.none-bordered) span:after {
			background: <?= $design['footer-fg'] ?>;
		}
		#footer * {
			color: <?= $design['footer-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['footer-fv'] != ""): ?>
		#footer a:hover {
			color: <?= $design['footer-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['copyright-bg'] != ""): ?>
		#copyright {
			background: <?= $design['copyright-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['copyright-fg'] != ""): ?>
		#copyright * {
			color: <?= $design['copyright-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['copyright-fv'] != ""): ?>
		#copyright a:hover {
			color: <?= $design['copyright-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-top-bg']): ?>
		#index-top .item a {
			background: <?= $design['index-top-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-top-br']): ?>
		#index-top .item a {
			border-top: solid 5px <?= $design['index-top-br'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-top-ff']): ?>
		#index-top .item .item-title {
			color: <?= $design['index-top-ff'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-top-fg']): ?>
		#index-top .item .item-description {
			color: <?= $design['index-top-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-bf']): ?>
		#index-product .product-item-container {
			background: <?= $design['index-product-bf'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-bg']): ?>
		.product-item-container .item .item-title {
			background: rgba(<?= hexdec(substr($design['index-product-bg'], 1, 2)) ?>, <?= hexdec(substr($design['index-product-bg'], 3, 2)) ?>, <?= hexdec(substr($design['index-product-bg'], 5, 2)) ?>, .8);
		}
	<?php endif; ?>
	<?php if ($design['index-product-bv']): ?>
		.product-item-container .item:hover .item-title {
			background: rgba(<?= hexdec(substr($design['index-product-bv'], 1, 2)) ?>, <?= hexdec(substr($design['index-product-bv'], 3, 2)) ?>, <?= hexdec(substr($design['index-product-bv'], 5, 2)) ?>, .8);
		}
	<?php endif; ?>
	<?php if ($design['index-product-br']): ?>
		.product-item-container .item .item-title {
			border-top: solid 5px <?= $design['index-product-br'] ?>;
		}
		.product-list.list-view .product-item-container .item .item-title {
			border-top: none;
			border-left: solid 5px <?= $design['index-product-br'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-title-fg']): ?>
		.product-item-container .item .item-title {
			color: <?= $design['index-product-title-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-body-fg']): ?>
		.product-item-container .item .item-body {
			color: <?= $design['index-product-body-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-price-sale-fg']): ?>
		.product-item-container .item .item-price-sale {
			color: <?= $design['index-product-price-sale-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-product-price-fg']): ?>
		.product-item-container .item .item-price {
			color: <?= $design['index-product-price-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-post-bf']): ?>
		.post-item-container .item {
			color: <?= $design['index-post-bf'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-post-bg']): ?>
		.post-item-container .item .item-heading {
			background: <?= $design['index-post-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-post-bv']): ?>
		.post-item-container .item:hover .item-heading {
			background: <?= $design['index-post-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-post-fg']): ?>
		.post-item-container .item .item-heading {
			color: <?= $design['index-post-fg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['index-post-fv']): ?>
		.post-item-container .item:hover .item-heading {
			color: <?= $design['index-post-fv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['readmore-bg']): ?>
		.readmore-button {
			background: <?= $design['readmore-bg'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['readmore-bv']): ?>
		.readmore-button:hover {
			background: <?= $design['readmore-bv'] ?>;
		}
	<?php endif; ?>
	<?php if ($design['readmore-fg']): ?>
		.readmore-button {
			color: <?= $design['readmore-fg'] ?> !important;
		}
	<?php endif; ?>
	<?php if ($design['readmore-fv']): ?>
		.readmore-button:hover {
			color: <?= $design['readmore-fv'] ?> !important;
		}
	<?php endif; ?>
	<?php if ($design['product-navigation-bg']): ?>
		#content.product .content-navigation span {
			background: <?= $design['product-navigation-bg'] ?> !important;
		}
	<?php endif; ?>
	<?php if ($design['product-navigation-fg']): ?>
		#content.product .content-navigation span {
			color: <?= $design['product-navigation-fg'] ?> !important;
		}
	<?php endif; ?>
	<?php if ($design['product-navigation-bv']): ?>
		#content.product .content-navigation span:hover {
			background: <?= $design['product-navigation-bv'] ?> !important;
		}
	<?php endif; ?>
	<?php if ($design['product-navigation-fv']): ?>
		#content.product .content-navigation span:hover {
			color: <?= $design['product-navigation-fv'] ?> !important;
		}
	<?php endif; ?>
</style>
<script>
	$(document).ready(function () {
		<?php if (in_array($template, array( "post", "post_detail" ))) { ?>
			var current = <?= $limit ?>;
			var step = <?= $step ?>;
			$("#content.category-post .readmore-button, #content.post .readmore-button").click(function () {
				var button = $(this);
				var target = button.parents("#content").find(".post-list");
				$.ajax({
					url: "<?= getAjaxURL() ?>post_loadmore.php",
					data: { current: current, step: step, lang: "<?= $_GET['lang'] ?>", post_id: "<?= $template=="post_detail" ? $post['id'] : "" ?>", category_id: "<?= $template=="post" ? $category['id'] : $post['category_id'] ?>", container: [target.find(".post-item-container").parent().attr("class"), target.find(".post-item-container").attr("class")] },
					type: "post",
					dataType: "json",
					success: function (res) {
						if(!res.continue)
							button.hide();
						target.append(res.data);
						current += step;
						post_resize();
					}
				});
			});
			setTimeout(function () {
				post_resize();
			}, 500);
		<?php } ?>
		<?php if (in_array($template, array( "product", "product_detail", "search", "tim-kiem", "filter" ))) { ?>
			var current = <?= intval($limit) ?>;
			var step = <?= intval($step) ?>;
			$("#content.category-product .readmore-button, #content.product .readmore-button").click(function () {
				var button = $(this);
				var target = button.parents("#content").find(".product-list");
				$.ajax({
					url: "<?= getAjaxURL() ?>product_loadmore.php",
					data: { current: current, step: step, readmore: "<?= $lang['column_1'] ?>", lang: "<?= $_GET['lang'] ?>", product_id: "<?= $template=="product_detail" ? $product['id'] : "" ?>", category_id: "<?= $template=="product" ? $category['id'] : $product['category_id'] ?>", container: [target.find(".product-item-container").parent().attr("class"), target.find(".product-item-container").attr("class")] },
					type: "post",
					dataType: "json",
					success: function (res) {
						if(!res.continue)
							button.hide();
						target.append(res.data);
						current += step;
						product_resize();
					}
				});
			});
			setTimeout(function () {
				product_resize();
			}, 500);
		<?php } ?>
	});
	function post_resize() {
		var hmax = 0;
		$(".post-list .post-item-container").each(function() {
			$(this).find(".item-thumbnail img").css("height", "calc(" + $(this).find(".item-thumbnail img").outerWidth() + "px * 570 / 760)");
			if(hmax < $(this).find(".item-heading").outerHeight())
				hmax = $(this).find(".item-heading").outerHeight();
		});
		if(hmax > 0)
			$(".post-list .post-item-container .item-heading").css("min-height", hmax + "px");
	}
	function product_resize() {
		$(".product-list .product-item-container .item-thumbnail img").each(function() {
			$(this).css("height", "calc(" + $(this).outerWidth() + "px * 570 / 760)");
		});
		$("#content .category-left").css("min-height", $("#content .category-right").outerHeight() + "px");
		$(document).trigger("scroll");
	}
</script>
<style>
	<?php if (in_array($template, array( "product", "product_detail" ))): ?>
		.product-item-container {
			margin-bottom: 30px;
		}
	<?php endif; ?>
	<?php if (in_array($template, array( "post", "post_detail" ))): ?>
		.post-item-container {
			margin-bottom: 30px;
		}
	<?php endif; ?>
</style>