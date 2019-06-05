<div class="well">Thêm/Cập nhật ngôn ngữ '<?= $item['uri'] ?>'</div>

<form action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<input name="id" type="hidden" value="<?=@$item['id']?>">
	<input name="type" type="hidden" value="<?=$type?>">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">Tiêu đề:</label></td>
			<td class="col-xs-8">
				<input name="title" type="text" class="form-control required" placeholder="Nhập tiêu đề" title="Tiêu đề ngôn ngữ" value="<?=@$item['title']?>" autofocus>
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">Đường dẫn:</label></td>
			<td class="col-xs-8">
				<input name="uri" type="text" class="form-control required" placeholder="Nhập tiêu đề" title="Đường dẫn ngôn ngữ" value="<?=@$item['uri']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">Hình hiện tại:</label></td>
			<td class="col-xs-8">
				<img id="thumb" src="<?=$item['thumbnail']!=''?(count(explode("://", $item['thumbnail']))>1?$item['thumbnail']:str_replace("//", "/", $item['thumbnail'])):''?>" width="100px" height="100px" alt="Chưa có hình đại diện">
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">&nbsp;</label></td>
			<td class="col-xs-8">
				<button type="button" class="btn btn-primary" onclick="openBrowser('#thumb', '#thumbnail');">Chọn hình</button>
				&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger" onclick="$('#thumbnail').val('');$('#thumb').attr('src','');">Xóa hình</button>
				<input id="thumbnail" name="thumbnail" type="hidden" value="<?=$item['thumbnail']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">Đường dẫn khác:</label></td>
			<td class="col-xs-8">
				<input name="url" type="text" class="form-control" placeholder="Nhập đường dẫn hình khác" title="Đường dẫn đến hình ngoài hệ thống" value="">
			</td>
		</tr>
		<?php foreach ($trans_array as $k_trans => $r_trans): ?>
			<tr>
				<td class="col-xs-4"><label class="form-control"><?= $r_trans ?>:</label></td>
				<td class="col-xs-8">
					<input name="<?= $k_trans ?>" type="text" class="form-control" placeholder="Nhập chuỗi phiên dịch" value="<?= $item[$k_trans] ?>">
				</td>
			</tr>
		<?php endforeach ?>
	
		<tr>
			<td class="col-xs-4"><label class="form-control">Thứ tự hiển thị:</label></td>
			<td class="col-xs-8">
				<input name="index" type="number" min="0" max="10000" class="form-control" placeholder="Nhập thứ tự" title="Thứ tự hiển thị" value="<?=@$item!="" ? $item['index'] : "0"?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-4"><label class="form-control">Trạng thái hiển thị:</label></td>
			<td class="col-xs-8">
				<select name="enable" class="form-control" title="Cho phép hiển thị và truy cập vào ngôn ngữ">
					<option value="1"<?=in_array($item['enable'], array(NULL, 1))?" selected":""?>>Có</option>
					<option value="0"<?=!in_array($item['enable'], array(NULL, 1))?" selected":""?>>Không</option>
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
