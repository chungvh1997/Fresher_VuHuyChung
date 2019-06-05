<div class="item">
	<a href="<?= getURL($r_product['uri']) ?>">
		<div class="item-thumbnail"><img src="<?= $r_product['thumbnail'] ?>"></div>
		
		<div class="item-title">
			<h2><?= $r_product['title'] ?></h2>
		</div>
			<div class="item-body">
				<?php 
					$data = getItems(array("table" => "province" ,"id" => $r_product['province']));
				 ?>
				<ul>
					<li> 
						<span>Địa điểm:</span>&nbsp;
							<?=$data['name']?>
						
					</li>
					<li> 
						<span>Diện tích từ:</span>&nbsp;<?= $r_product['dientich'] ?>
					</li>
					<li> 
						<span>Số phòng ngủ:</span>&nbsp;<?= $r_product['phongngu'] ?>
					</li>
					<li> 
						<span>Loại hình:</span>&nbsp;<?= $r_product['loaihinh'] ?>
					</li>
				</ul>
			</div>
	</a>
</div>