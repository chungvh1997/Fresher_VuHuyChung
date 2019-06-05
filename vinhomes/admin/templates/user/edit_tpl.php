<div class="well">Thêm / Cập nhật tài khoản <?=!empty($item) ? "'".implode(" ", array_slice(explode(" ", $item['title']), 0, 3)) . (substr_count($item['title'], " ")>2 ? "..." : "") ."'" : ""?></div>

<form id="userfrm" action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=".$act, "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8" onsubmit="return validate(this);">
	<input name="id" type="hidden" value="<?=@$item['id']?>">
	<input name="react" type="hidden" value="<?=$act?>">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Tên đăng nhập:</label></td>
			<td class="col-xs-10">
				<input name="username" type="text" class="form-control required" placeholder="Nhập tên đăng nhập" title="Tên đăng nhập vào hệ thống" value="<?=$item['username']?>" autofocus>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Mật khẩu:</label></td>
			<td class="col-xs-10">
				<input id="password" name="password" type="password" class="form-control" placeholder="Nhập mật khẩu" title="Mật khẩu đăng nhập vào hệ thống" value="">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Xác nhận mật khẩu:</label></td>
			<td class="col-xs-10">
				<input id="confirm" type="password" class="form-control" placeholder="Nhập lại mật khẩu" title="Xác nhận mật khẩu đăng nhập vào hệ thống" value="">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Email:</label></td>
			<td class="col-xs-10">
				<input name="email" type="email" class="form-control required" placeholder="Nhập tên đăng nhập" title="Tên đăng nhập vào hệ thống" value="<?=$item['email']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Tên người dùng:</label></td>
			<td class="col-xs-10">
				<input name="fullname" type="text" class="form-control" placeholder="Nhập tên người dùng" title="Tên đầy đủ của người dùng" value="<?=$item['fullname']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Địa chỉ:</label></td>
			<td class="col-xs-10">
				<textarea name="address" class="form-control" rows="3" placeholder="Nhập tên địa chỉ" title="Địa chỉ của người dùng"><?=$item['address']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Điện thoại người dùng:</label></td>
			<td class="col-xs-10">
				<input name="tel" type="text" class="form-control" placeholder="Nhập điện thoại" title="Điện thoại của người dùng" value="<?=$item['tel']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Loại tài khoản:</label></td>
			<td class="col-xs-10">
				<?php if(checkAdmin()): ?>
					<select name="type" class="form-control" title="Loại tài khoản">
						<?php foreach ($type_list as $k => $t): ?>
							<option value="<?=$k?>" <?=$k==$item['type'] ? "selected" : ""?>><?=$t?></option>
						<?php endforeach ?>
					</select>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Trạng thái hiển thị:</label></td>
			<td class="col-xs-10">
				<select name="enable" class="form-control" title="Cho phép hiển thị và truy cập vào sản phẩm">
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

<script type="text/javascript">
	function validate(frm) {
		if(frm.password.value != frm.confirm.value) {
			alert("Xác nhận mật khẩu không trùng khớp!");
			frm.password.focus();
			return false;
		}
		return true;
	}
</script>

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
