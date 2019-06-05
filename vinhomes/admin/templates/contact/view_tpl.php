<div class="well">Nội dung chi tiết tin liên hệ  từ '<?=$item['name']?>' vào ngày '<?=date("d/m/Y", $item['create_date'])?>'</div>
<table class="table table-striped table-bordered">
	<tr>
		<td class="col-xs-3"><label class="form-control">Họ tên:</label></td>
		<td class="col-xs-9"><label class="form-control"><?=$item['name']?></label></td>
	</tr>
<!--	<tr>
		<td><label class="form-control">Địa chỉ người gửi:</label></td>
		<td><label class="form-control"><?=$item['address']?></label></td>
	</tr>-->
	<tr>
		<td><label class="form-control">Điện thoại:</label></td>
		<td><label class="form-control"><?=$item['tel']?></label></td>
	</tr>
	<tr>
		<td><label class="form-control">Email:</label></td>
		<td><label class="form-control"><?=$item['email']?></label></td>
	</tr>
	<tr>
		<td><label class="form-control">Ngày gửi:</label></td>
		<td><label class="form-control"><?=date('d/m/Y H:i:s', $item['create_date'])?></label></td>
	</tr>
	<tr>
		<td><label class="form-control">Nội dung:</label></td>
		<td><label class="form-control"><?=$item['content']?></label></td>
	</tr>
	</tr>
	<!-- <tr>
		<td><label class="form-control">Loại liên hệ:</label></td>
		<td><label class="form-control"><?=$item['type']?></label></td>
	</tr> -->
</table>
<div class="text-center">
	<a href="<?=str_replace("&act=view", "&act=list", getCurrentPageURL())?>" class="btn btn-warning">Quay lại</a>
</div>

<style type="text/css">
.well {
	font-size: 30px;
	color: darkred;
	font-weight: bold;
	text-align: center;
}
.table td {
	/*border: none !important;*/
	padding: 0 !important;
}

label.form-control {
	border: none;
	box-shadow: none;
	margin-bottom: 0;
	background: transparent;
}

input[type='file'], select {
	width: auto !important;
}
</style>