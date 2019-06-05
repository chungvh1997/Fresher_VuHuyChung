<div class="well">Danh sách tài khoản (<?=$pagination->count_item?>)</div>

<table class="table table-striped table-bordered text-center">
	<tr>
		<td class="text-left" colspan="14">
			<?php include _template."input/add.php"; ?>
		</td>
	</tr>
	<tr>
		<th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');" /></th>
		<th>STT</th>
		<th>Tên đăng nhập</th>
		<th>Email</th>
		<th>Tên người dùng</th>
		<th>Loại tài khoản</th>
		<th>Sửa</th>
		<th>Hiển thị</th>
		<th>Xóa</th>
	</tr>
	<?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
		<tr>
			<td>
				<?php include _template."input/checkbox.php"; ?>
			</td>
			<td><?=$u?></td>
			<td><?=$value['username']?></td>
			<td><?=$value['email']?></td>
			<td><?=$value['fullname']?></td>
			<td><?=$type_list[$value['type']]?></td>
			<td>
				<?php include _template."input/edit.php"; ?>
			</td>
			<td>
				<?php include _template."input/enable.php"; ?>
			</td>
			<td>
				<?php include _template."input/delete.php"; ?>
			</td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="14">
			<?php include _template."input/add.php"; ?>
			<?php include _template."input/delall.php"; ?>
		</td>
	</tr>
	<?php if($pagination->count > 1) { ?>
	<tr>
		<td colspan="14">
			<?= $paging ?>
		</td>
	</tr>
	<?php } ?>
</table>

<style type="text/css">
.table th {
	text-align: center;
}
.table td {
	vertical-align: middle !important;
}
.table td[colspan='9'] {
	border-bottom: none !important;
	border-left: none !important;
	border-right: none !important;
}
.well {
	font-size: 30px;
	color: darkred;
	font-weight: bold;
	text-align: center;
}
</style>
