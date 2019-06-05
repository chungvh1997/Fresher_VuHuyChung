<?php
function getAttr($index, $attr = "") {
	return "
		<img id='attr_img_".($index)."' src='".(@$attr[0][$index]!=''?(count(explode('://', @$attr[0][$index]))>1?@$attr[0][$index]:str_replace('//', '/', @$attr[0][$index])):'')."' width='100px' height='100px' title='Chọn icon thuộc tính' alt='Duyệt' onclick=\"openBrowser('#attr_img_".($index)."', '#attr_img".($index)."');\" style='display: inline-block; width: 34px; height: 34px; background: #dcdcdc; -border: solid 1px gray; cursor: pointer;'>
		<button type='button' class='btn btn-danger' onclick=\"$('#attr_img".($index)."').val(''); $('#attr_img_".($index)."').attr('src','');\" style='display: inline-block;width: 20px; height: 20px; line-height: 20px; font-size: 10px; outline: none !important; box-shadow: none !important; border: none !important; padding: 0;'>X</button>
		<input id='attr_img".($index)."' name='attr_img[]' type='hidden' value='".(@$attr[0][$index])."'>
		<input type='text' name='attr_text[]' class='form-control' value='".(@$attr[1][$index])."' placeholder='Nhập tên thuộc tính' style='display: inline-block; width: calc(25% - 100px);'>
	";
}
?>

<div class="well">Thêm / Cập nhật sản phẩm <?=!empty($item) ? "'".implode(" ", array_slice(explode(" ", $item['title']), 0, 3)) . (substr_count($item['title'], " ")>2 ? "..." : "") ."'" : ""?></div>

<form action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="id" type="hidden" value="<?=@$item['id']?>">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Danh mục sản phẩm:</label></td>
			<td class="col-xs-10">
				<select name="category_id" class="form-control required" title="Danh mục sản phẩm">
					<option value="" disabled selected>Chọn danh mục sản phẩm</option>
					<?php
					foreach ($row_category as $val) {
						$tmp = explode(" / ", getCategoryPath($val['id']));
						array_pop($tmp);
						$tmp = implode(" / ", $tmp);
						?>
						<option value="<?=$val['id']?>" <?=$val['id']==$item['category_id'] ? " selected" : ""?>>
							<?= $val['title'] ?><?= $tmp!="" ? "&nbsp;&nbsp;&nbsp;({$tmp})" : "" ?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Danh mục dự án:</label></td>
			<td class="col-xs-10">
				<select name="project_id" class="form-control" title="Danh mục dự án">
					<option value="" disabled selected>Chọn danh mục dự án</option>
					<?php
					foreach ($row_project as $val) {
						$tmp = explode(" / ", getCategoryPath($val['id'])); 
						array_pop($tmp);
						$tmp = implode(" / ", $tmp);
						?>
						<option value="<?=$val['id']?>" <?=$val['id']==$item['project_id'] ? " selected" : ""?>>
							<?= $val['title'] ?><?= $tmp!="" ? "&nbsp;&nbsp;&nbsp;({$tmp})" : "" ?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<!-- <tr>
			<td class="col-xs-2"><label class="form-control">Danh mục thương hiệu:</label></td>
			<td class="col-xs-10">
				<select name="brand_id" class="form-control" title="Danh mục thương hiệu">
					<option value="" selected>Chọn danh mục thương hiệu</option>
					<?php
					foreach ($row_brand as $val) {
						$tmp = explode(" / ", getCategoryPath($val['id']));
						array_pop($tmp);
						$tmp = implode(" / ", $tmp);
						?>
						<option value="<?=$val['id']?>" <?=$val['id']==$item['brand_id'] ? " selected" : ""?>>
							<?= $val['title'] ?><?= $tmp!="" ? "&nbsp;&nbsp;&nbsp;({$tmp})" : "" ?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr> -->
		<tr>
			<td class="col-xs-2"><label class="form-control">Hình hiện tại:<?= getSize(760, 570) ?></label></td>
			<td class="col-xs-10">
				<img id="thumb" src="<?=$item['thumbnail']!=''?(count(explode("://", $item['thumbnail']))>1?$item['thumbnail']:str_replace("//", "/", $item['thumbnail'])):''?>" alt="Chưa có hình đại diện" onclick="openBrowser('#thumb', '#thumbnail');" style="cursor: pointer; height: calc(150px * 570 / 760) !important;">&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-primary" onclick="openBrowser('#thumb', '#thumbnail');">Chọn hình</button>&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-danger" onclick="$('#thumbnail').val('');$('#thumb').attr('src','');">Xóa hình hiện tại</button>
				<input id="thumbnail" name="thumbnail" type="hidden" value="<?=$item['thumbnail']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Đường dẫn khác:</label></td>
			<td class="col-xs-10">
				<input name="url" type="text" class="form-control" placeholder="Nhập đường dẫn khác cho hình ảnh" title="Đường dẫn cố định cho hình ảnh">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Mã sản phẩm:</label></td>
			<td class="col-xs-10">
				<input name="serial" type="text" class="form-control" placeholder="Nhập mã sản phẩm" value="<?=$item['serial']?>">
			</td>
		</tr>
		
			
		<!--	
			<tr>
				<td class="col-xs-2"><label class="form-control">Quận - Huyện:</label></td>
				<td class="col-xs-10">
					<select class="form-control fleft" name="district" data-table="ward" data-target="select[name='ward']" onchange="load_sel(this);" data-default="<option value='' selected disabled>Chọn Quận - Huyện</option>">
						<option value="" selected disabled>Chọn Quận - Huyện</option>
						<?php foreach ($row_district as $r_district): ?>
							<option value="<?=$r_district['id']?>" <?= $r_district['id']==@$item['district'] ? "selected" : "" ?>><?=$r_district['type']?> <?=$r_district['name']?></option>
						<?php endforeach ?>
					</select>
			</tr>
			<tr>
				<td class="col-xs-2"><label class="form-control">Phường - Xã:</label></td>
				<td class="col-xs-10">
					<select class="form-control fleft" name="ward" data-default="<option value='' selected disabled>Chọn Phường - Xã</option>">
						<option value="" selected disabled>Chọn Phường - Xã</option>
						<?php foreach ($row_ward as $r_ward): ?>
							<option value="<?=$r_ward['id']?>" <?= $r_ward['id']==@$item['ward'] ? "selected" : "" ?>><?=$r_ward['type']?> <?=$r_ward['name']?></option>
						<?php endforeach ?>
					</select>
				</td>
			</tr>
		-->
		<!-- <?php
		$item['attribute'] = explode("&#", @$item['attribute']);
		$item['attribute'][0] = explode(";", @$item['attribute'][0]);
		$item['attribute'][1] = explode(";", @$item['attribute'][1]);
		for ($i=0; $i<12; $i++):
			if($i%4 == 0) echo "<tr><td colspan='2'>";
				echo getAttr($i, @$item['attribute']);
			if(in_array($i%4, array( 1, 2, 3 )))
				echo "<span style='display: inline-block; width: 1px; height: 34px; border-left: solid 1px black; margin-bottom: -12px; margin-left: 10px; margin-right: 10px;'></span>";
			if($i%4 == 3) echo "<tr><td colspan='14'>";
		endfor; ?> -->
		<!-- <tr>
			<td class="col-xs-2"><label class="form-control">Mô tả ngắn:</label></td>
			<td class="col-xs-10">
				<textarea name="sumary" class="form-control" placeholder="Nhập mô tả" title="Mô tả hiển thị trên catalog" rows="3"><?=$item['sumary']?></textarea>
			</td>
		</tr> -->
		<tr>
			<td class="col-xs-2"><label class="form-control">Độ ưu tiên:</label></td>
			<td class="col-xs-10">
				<input name="level" type="number" min="0" max="10000" class="form-control" placeholder="Độ ưu tiên" title="Mức độ hiển thị ưu tiên" value="<?=empty($item)?"0":$item['level']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Trạng thái hiển thị:</label></td>
			<td class="col-xs-10">
				<select name="enable" class="form-control" title="Cho phép hiển thị và truy cập vào sản phẩm">
					<option value="1"<?=in_array(@$item['enable'], array("", 1, "1"))?" selected":""?>>Có</option>
					<option value="0"<?=!in_array(@$item['enable'], array("", 1, "1"))?" selected":""?>>Không</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Sản phẩm nổi bật:</label></td>
			<td class="col-xs-10">
				<select name="popular" class="form-control">
					<option value="1"<?=in_array(@$item['popular'], array("", 1, "1"))?" selected":""?>>Có</option>
					<option value="0"<?=!in_array(@$item['popular'], array("", 1, "1"))?" selected":""?>>Không</option>
				</select>
			</td>
		</tr>
		<tr>
				<td class="col-xs-2"><label class="form-control">Tỉnh - Thành phố:</label></td>
				<td class="col-xs-10">
					<select class="form-control fleft" name="province" data-table="district" data-target="select[name='district']" onchange="load_sel(this);">
						<option value="" selected disabled>Chọn Tỉnh - Thành phố</option>
						<?php foreach ($row_province as $r_province): ?>
							<option value="<?=$r_province['id']?>" <?= $r_province['id']==@$item['province'] ? "selected" : "" ?>><?=$r_province['type']?> <?=$r_province['name']?></option>
						<?php endforeach ?>
					</select>
			</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Diện tích:</label></td>
			<td class="col-xs-10">
				<?php $item['dientich'] = explode(";", $item['dientich']);?>
					<div class="checkboxs"><input <?= in_array("Dưới 50m²", $item['dientich'])?"checked":"" ?> type="checkbox" name="dientich[]" value="Dưới 50m²"> Dưới 50m²</div>
					<div class="checkboxs"><input <?= in_array("50-100m²", $item['dientich'])?"checked":"" ?> type="checkbox" name="dientich[]" value="50-100m²"> 50-100m²</div>
					<div class="checkboxs"><input <?= in_array("100-150m²", $item['dientich'])?"checked":"" ?> type="checkbox" name="dientich[]" value="100-150m²"> 100-150m²</div>
					<div class="checkboxs"><input <?= in_array("150-300m²", $item['dientich'])?"checked":"" ?>  type="checkbox" name="dientich[]" value="150-300m²"> 150-300m²</div>
					<div class="checkboxs"><input <?= in_array("Trên 300m²", $item['dientich'])?"checked":"" ?> type="checkbox" name="dientich[]" value="Trên 300m²"> Trên 300m²</div>
			
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Số phòng ngủ:</label></td>
			<td class="col-xs-10">
				<?php $item['phongngu'] = explode(";", $item['phongngu']);?>
					<div class="checkboxs"><input <?= in_array("1 Phòng ngủ", $item['phongngu'])?"checked":"" ?> type="checkbox" name="phongngu[]" value="1 Phòng ngủ"> 1 Phòng ngủ</div>
					<div class="checkboxs"><input <?= in_array("2 Phòng ngủ", $item['phongngu'])?"checked":"" ?> type="checkbox" name="phongngu[]" value="2 Phòng ngủ"> 2 Phòng ngủ</div>
					<div class="checkboxs"><input <?= in_array("3 Phòng ngủ", $item['phongngu'])?"checked":"" ?> type="checkbox" name="phongngu[]" value="3 Phòng ngủ"> 3 Phòng ngủ</div>
					<div class="checkboxs"><input <?= in_array("4 Phòng ngủ", $item['phongngu'])?"checked":"" ?> type="checkbox" name="phongngu[]" value="4 Phòng ngủ"> 4 Phòng ngủ</div>
					<div class="checkboxs"><input <?= in_array("Trên 4 Phòng ngủ", $item['phongngu'])?"checked":"" ?> type="checkbox" name="phongngu[]" value="Trên 4 Phòng ngủ"> Trên 4 Phòng ngủ</div>
				
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Loại hình:</label></td>
			<td class="col-xs-10">
				<?php $item['loaihinh'] = explode(";", $item['loaihinh']);?>
					<div class="checkboxs"><input <?= in_array("Biệt thự", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Biệt thự"> Biệt thự</div>
					<div class="checkboxs"><input <?= in_array("Biệt thự nghỉ dưỡng", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Biệt thự nghỉ dưỡng"> Biệt thự nghỉ dưỡng
</div>
					<div class="checkboxs"><input <?= in_array("Biệt thự trên không", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Biệt thự trên không"> Biệt thự trên không</div>
					<div class="checkboxs"><input <?= in_array("Căn hộ", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Căn hộ"> Căn hộ</div>
					<div class="checkboxs"><input <?= in_array("Căn hộ dịch vụ", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Căn hộ dịch vụ"> Căn hộ dịch vụ</div>
					<div class="checkboxs"><input <?= in_array("Căn hộ khách sạn", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Căn hộ khách sạn"> Căn hộ khách sạn</div>
					<div class="checkboxs"><input <?= in_array("Nhà phố thương mại", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Nhà phố thương mại"> Nhà phố thương mại</div>
					<div class="checkboxs"><input <?= in_array("Shop-Office", $item['loaihinh'])?"checked":"" ?> type="checkbox" name="loaihinh[]" value="Shop-Office"> Shop-Office</div>
			
			</td>
		</tr>
	</table>
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach($row_language as $k_language => $r_language): ?>
			<li role="presentation" <?= $k_language==0 ? 'class="active"' : "" ?>>
				<a href="#<?= $r_language['uri'] ?>" aria-controls="<?= $r_language['uri'] ?>" role="tab" data-toggle="tab">
					<img src="<?= $r_language['thumbnail'] ?>" style="height: 30px;">
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="tab-content">
		<?php foreach($row_language as $k_language => $r_language): $item = $row_translate[$k_language]; ?>
			<div id="<?= $r_language['uri'] ?>" role="tabpanel" class="tab-pane fade <?= $k_language==0 ? "in active" : "" ?>">
				<table class="table">
					<tr>
						<td class="col-xs-2"><label class="form-control">Tiêu đề:</label></td>
						<td class="col-xs-10">
							<input name="title_<?=$r_language['uri']?>" type="text" class="form-control required" placeholder="Nhập tiêu đề <?=$r_language['title']?>" title="Tiêu đề hiển thị <?= $r_language['title'] ?>" value="<?=$item['title']?>" autofocus>
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Giá bán:</label></td>
						<td class="col-xs-10">
							<input name="price_sale_<?=$r_language['uri']?>" type="text" class="form-control price-promotion" placeholder="Nhập giá bán sản phẩm" value="<?=$item['price_sale']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Giá gốc:</label></td>
						<td class="col-xs-10">
							<input name="price_<?=$r_language['uri']?>" type="text" class="form-control price" placeholder="Nhập giá gốc sản phẩm" value="<?=$item['price']?>">
						</td>
					</tr>
					<script>
						$(document).ready(function() {
							$(".price").change(function () {
								$(".price-promotion").attr("max", $(this).val());
							});
							$(".price").trigger("change");
						});
					</script>
					<tr>
						<td class="col-xs-2">
							<label class="form-control">Mô tả <span class="glyphicon glyphicon-info-sign" title="Mô tả sơ lược về sản phẩm"></span>:</label>
						</td>
						<td class="col-xs-10">
							<textarea name="description_<?=$r_language['uri']?>" id="description__<?=$r_language['uri']?>" class="editor"><?=$item['description']?></textarea>
						</td>
					</tr>
					 <tr>
						<td class="col-xs-2">
							<label class="form-control">Giới thiệu <span class="glyphicon glyphicon-info-sign" title="Giới thiệu về dự án"></span>:</label>
						</td>
						<td class="col-xs-10">
							<textarea name="content_<?=$r_language['uri']?>" id="content__<?=$r_language['uri']?>" class="editor"><?=$item['content']?></textarea>
						</td>
					</tr> 
					 <tr>
						<td class="col-xs-2">
							<label class="form-control">Thông tin liên hệ dự án <span class="glyphicon glyphicon-info-sign" title="Giới thiệu về dự án"></span>:</label>
						</td>
						<td class="col-xs-10">
							<textarea name="first_tag_<?=$r_language['uri']?>" id="first_tag_<?=$r_language['uri']?>" class="editor"><?=$item['first_tag']?></textarea>
						</td>
					</tr>  
					 <tr>
						<td class="col-xs-2">
							<label class="form-control">Thông tin ban quản lí dự án <span class="glyphicon glyphicon-info-sign" title="Thông tin ban quản lí dự án"></span>:</label>
						</td>
						<td class="col-xs-10">
							<textarea name="second_tag_<?=$r_language['uri']?>" id="second_tag_<?=$r_language['uri']?>" class="editor"><?=$item['second_tag']?></textarea>
						</td>
					</tr> 
					<tr>
						<td class="col-xs-2"><label class="form-control">Keyword:</label></td>
						<td class="col-xs-10">
							<input name="keyword_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập keyword" title="Keyword có chức năng tăng mức độ SEO" value="<?=$item['keyword']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Description:</label></td>
						<td class="col-xs-10">
							<input name="desc_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập description" title="Description có chức năng tăng mức độ SEO" value="<?=$item['desc']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H1:</label></td>
						<td class="col-xs-10">
							<input name="h1_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H1" title="H1, H2, H3 có chức năng tăng mức độ SEO" value="<?=$item['h1']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H2:</label></td>
						<td class="col-xs-10">
							<input name="h2_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H2" title="H1, H2, H3 có chức năng tăng mức độ SEO" value="<?=$item['h2']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H3:</label></td>
						<td class="col-xs-10">
							<input name="h3_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H3" title="H1, H2, H3 có chức năng tăng mức độ SEO" value="<?=$item['h3']?>">
						</td>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>
	</div>
	<table class="table">
		<tr>
			<td colspan="2" class="text-center">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
	</table>
</form>

<style type="text/css">
.well {
	font-size: 30px;
	color: darkred;
	font-weight: bold;
	text-align: center;
}
.table td {
	border: none !important;
}

label.form-control {
	border: none;
	box-shadow: none;
}

input[type='file'], select {
	width: auto !important;
}

abbr {
	color: gray;
}
.checkboxs{
    float: left!important;
    margin-right: 35px;
}
}
</style>
