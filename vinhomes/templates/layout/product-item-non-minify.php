<div class="item">
	<a href="<?= getURL($r_product['uri']) ?>">
		<div class="item-thumbnail"><img src="<?= $r_product['thumbnail'] ?>"></div>
		<div class="item-title">
			<?= $r_product['title'] ?>
			<div class="item-body">Giá:
				<span class="item-price-sale"><?= $r_product['price_sale'] != "" ? $r_product['price_sale'] : "Liên hệ" ?></span>
				<del class="item-price"><?= $r_product['price'] != "" ? "(".$r_product['price'].")" : "" ?></del>
			</div>
		</div>
	</a>
</div>