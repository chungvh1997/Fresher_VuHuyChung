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
		#footer, #footer a {
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
			$("#content-product.category-product .readmore-button, #content-product.product .readmore-button").click(function () {
				var button = $(this);
				var target = button.parents("#content-product").find(".product-list");
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
		var hmax = 0;
		$(".product-list .product-item-container").each(function() {
			
			if(hmax < $(this).find(".item-title").outerHeight())
				hmax = $(this).find(".item-title").outerHeight();
		});
		if(hmax > 0)
			$(".product-list .product-item-container .item-title").css("min-height", hmax + "px");
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