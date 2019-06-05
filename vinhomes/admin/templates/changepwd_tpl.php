<div class="well">Cập nhật mật khẩu <?=!empty($account) ? "(".$account['username'].")" : ""?></div>

<form action="" onsubmit="return isValid();" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<table class="table">
		<tr>
			<td class="col-xs-2"><label class="form-control">Tên tài khoản:</label></td>
			<td class="col-xs-11">
				<label class="form-control"><?=$account['username']?></label>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Mật khẩu cũ:</label></td>
			<td class="col-xs-11">
				<input name="pwd_old" type="password" class="form-control required" placeholder="Nhập mật khẩu cũ" value="" autofocus>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Mật khẩu mới:</label></td>
			<td class="col-xs-11">
				<input id="pwd_new" name="pwd_new" type="password" class="form-control required" placeholder="Nhập mật khẩu mới" value="">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Xác nhận mật khẩu:</label></td>
			<td class="col-xs-11">
				<input id="pwd_confirm" type="password" class="form-control required" placeholder="Nhập lại mật khẩu mới" value="">
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<input name="changepwdbtn" type="submit" class="btn btn-success" value="Lưu lại">
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
function isValid(){
	if($("#pwd_new").val() == $("#pwd_confirm").val())
		return true;
	else{
		alert("Xác nhận mật khẩu không trùng khớp!");
		return false;
	}
};
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