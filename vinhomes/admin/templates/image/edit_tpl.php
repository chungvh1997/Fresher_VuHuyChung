<div class="well">Thêm/cập nhật <?=$title?>
<?php if(@$item!=""): ?><img src="<?=$item['thumbnail']?>"><?php endif; ?>
</div>

<form action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<input name="id" type="hidden" value="<?=@$item['id']?>">
	<input name="type" type="hidden" value="<?=@$type?>">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Tiêu đề:</label></td>
			<td class="col-xs-10">
				<input name="title" type="text" class="form-control" placeholder="Nhập tiêu đề" title="Tiêu đề hiển thị" value="<?=$item['title']?>" autofocus>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Hình hiện tại:</label></td>
			<td class="col-xs-10">
				<img id="thumb" src="<?=$item['thumbnail']!=''?(count(explode("://", $item['thumbnail']))>1?$item['thumbnail']:str_replace("//", "/", $item['thumbnail'])):''?>" alt="Chưa có hình đại diện" onclick="openBrowser('#thumb', '#thumbnail');" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-primary" onclick="openBrowser('#thumb', '#thumbnail');">Chọn hình</button>&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-danger" onclick="$('#thumbnail').val('');$('#thumb').attr('src','');">Xóa hình hiện tại</button>
				<input id="thumbnail" name="thumbnail" type="hidden" value="<?=$item['thumbnail']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Đường dẫn khác:</label></td>
			<td class="col-xs-10">
				<input name="url" type="text" class="form-control" placeholder="Nhập đường dẫn khác cho hình ảnh" title="Đường dẫn cố định">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Đường dẫn liên kết:</label></td>
			<td class="col-xs-10">
				<input name="link" type="text" class="form-control" placeholder="Nhập đường dẫn liên kết cho hình ảnh" title="Đường dẫn liên kết" value="<?= $item['link'] ?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Tên fontawesome:</label></td>
			<td class="col-xs-10">
				<input name="font_awesome" type="text" class="form-control" placeholder="Nhập tên fontawesome 5" title="Tên fontawesome" value="<?= $item['font_awesome'] ?>">
			</td>
		</tr>
		<?php if ($type == "slide"): ?>
			<tr>
				<td class="col-xs-2"><label class="form-control">Mô tả:</label></td>
				<td class="col-xs-10">
					<textarea name="description" class="form-control" placeholder="Nhập mô tả" title="Mô tả hiển thị trên catalog" rows="3"><?=$item['description']?></textarea>
				</td>
			</tr>
		<?php endif ?>
		<tr>
			<td class="col-xs-2"><label class="form-control">
				Thứ tự hiển thị:
			</label></td>
			<td class="col-xs-10">
				<input name="index" type="number" min="0" max="10000" class="form-control" placeholder="Độ ưu tiên" title="Mức độ hiển thị ưu tiên" value="<?=empty($item)?"0":$item['index']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Trạng thái hiển thị:</label></td>
			<td class="col-xs-10">
				<select name="enable" class="form-control required" title="Cho phép hiển thị và truy cập vào sản phẩm">
					<option value="1"<?=empty($item)||$item['enable']==1?" selected":""?>>Có</option>
					<option value="0"<?=!empty($item)&&$item['enable']==0?" selected":""?>>Không</option>
				</select>
			</td>
		</tr>
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
</style>
