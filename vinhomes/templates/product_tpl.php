<?php 
	$row_province = getItems(array("table" => "province"));
	$row_duan = getItems(array("table" => "category", "condition" => "where type ='project'"));
 ?>
<div id="search-bds" style="background-color: #fff;">
	<div class="<?= $container ?>">
		<p class="title-section">
			<?= $lang['column_22'] ?>
		</p>
		<p>
			<?= $lang['column_23'] ?>
			<b class="ng-binding"><?php foreach ($row_duan as $r_duan): ?>
					<?= $r_duan['title'] ?>,
				<?php endforeach ?>
			</b> <?= $lang['column_25'] ?>
		</p>
		<div class="fitter">
			<input type="text" id="inp2" oninput="Search_select()" placeholder="" name="ten-du-an" class="ten-du-an">
			<div class="boc-select">
				<select name="dia-diem" id="province" onchange="Search_select()"  class="input-fitter">
					<option value="" selected>Địa điểm</option>
					<?php foreach ($row_province as $r_province): ?>
						<option value="<?=$r_province['id']?>" <?= $r_province['id']==@$item['province'] ? "selected" : "" ?>> <?=$r_province['name']?></option>
					<?php endforeach ?>
				</select>
				<select name="loai-bds" id="product-type" onchange="Search_select()" class="input-fitter">
					<option value="" selected>Loại hình bất động sản</option>
					<option value="Biệt thự">Biệt thự</option>
					<option value="Biệt thự nghỉ dưỡng">Biệt thự nghỉ dưỡng</option>
					<option value="Biệt thự trên không">Biệt thự trên không</option>
					<option value="Căn hộ">Căn hộ</option>
					<option value="Căn hộ dịch vụ">Căn hộ dịch vụ</option>
					<option value="Căn hộ khách sạn">Căn hộ khách sạn</option>
					<option value="Nhà phố thương mại">Nhà phố thương mại</option>
					<option value="Shop-Office">Shop-Office</option>
				</select>
				<select name="du-an" id="duan" onchange="Search_select()" class="input-fitter">
					<option value="" selected>Dòng sản phẩm</option>
					<?php foreach ($row_duan as $r_duan): ?>
						<option value="<?= $r_duan['id'] ?>"><?= $r_duan['title'] ?></option>
					<?php endforeach ?>
				</select>
				<select name="dien-tich" id="acreages" onchange="Search_select()" class="input-fitter">
					<option value="" selected>Diện tích</option>
					<option value="Dưới 50m²">Dưới 50m²</option>
					<option value="50-100m²">50-100m²</option>
					<option value="100-150m²">100-150m²</option>
					<option value="150-300m²">150-300m²</option>
					<option value="Trên 300m²">Trên 300m²</option>
				</select>
				<select name="so-phong" id="room-number" onchange="Search_select()" class="input-fitter">
					<option value="" selected>Số phòng ngủ</option>
					<option value="1 Phòng ngủ">1 Phòng ngủ</option>
					<option value="2 Phòng ngủ">2 Phòng ngủ</option>
					<option value="3 Phòng ngủ">3 Phòng ngủ</option>
					<option value="4 Phòng ngủ">4 Phòng ngủ</option>
					<option value="Trên 4 Phòng ngủ">Trên 4 Phòng ngủ</option>
				</select>
			</div>
		</div>

		<div class="filter-location">
			<ul id="location">
				<?php foreach ($row_duan as $r_duan): ?>
					<li><a href="javascript:void(0)" onclick="$('#duan').val(<?=$r_duan['id']?>);Search_select()" ><?= $r_duan['title'] ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
<section id="content-product" class="category-product">
	<figure class="<?= $container ?>">
		<div class="row">
			<!-- sản phẩm item -->
			
				<div class="product-list grid-view row">
					<?php foreach ($row_product as $r_product): ?>
						<div class="col-md-4 col-xs-12">
							<div class="product-item-container">
								<?php include _template."layout/product-item.php" ?>
							</div>
						</div>

					<?php endforeach ?>
				</div>

		
			<div class="clearfix"></div>
			<?php if($num_product>$limit):?> 
                <div class="text-center view-all"> 
                    <button class="btn readmore-button"> 
                        <span><?=$lang['column_15']?></span> 
                        <span><i class="fa fa-chevron-down"></i></span> 
                    </button> 
                </div> 
            <?php endif;?>


		</div>
		<div id="dky-baogia">
			<?php include _template."layout/register.php" ?>
		</div>
			
	</figure>
</section>
<script>
	superplaceholder({
		el: inp2,
		sentences: ["<?= implode('","', explode(",", $lang['column_24'])) ?>"],
		options: {
			letterDelay: 80,
			loop: true,
			startOnFocus: false
		}
	})
	function Search_select(){
		$.ajax({
			url: '<?=getAjaxURL()?>search_select.php',
			type: 'POST',
			dataType: 'json',
			data: {
				lang: "<?= $_GET['lang'] ?>",
				province_id: $("#province").val(), 
				product_type: $("#product-type").val(), 
				duan: $("#duan").val(), 
				acreages: $("#acreages").val(),  
				room_number: $("#room-number").val(), 
				keyword: $("#inp2").val(), 

			},

			success:function(res){
				$(".product-list").html(res.data);
					product_resize();
			},
			error:function(err) {
				console.log(err);
			}
		});
		
		
		
	}
</script>
