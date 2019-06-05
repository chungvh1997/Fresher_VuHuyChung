<div class='well'>Danh sách ngôn ngữ</div>

<table class="table table-striped table-bordered text-center">
	<tr>
		<td class="text-left" colspan="10">
			<?php include _template."input/add.php"; ?>
		</td>
	</tr>
	<tr>
		<th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');" /></th>
		<th>STT</th>
		<th>Tiêu đề</th>
		<th>Đường dẫn</th>
		<th>Ảnh đại diện</th>
		<th>Thứ tự hiển thị</th>
		<th>Sửa</th>
		<th>Hiển thị</th>
		<th>Xóa</th>
	</tr>
	<?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
		<tr>
			<td>
				<?php $disabled = checkAdmin($db) ? "" : "disabled"; include _template."/input/checkbox.php"; $disabled = ""; ?>
			</td>
			<td><?=$u?></td>
			<td><?=$value['title']?></td>
			<td><?=$value['uri']?></td>
			<td>
				<?php include _template."input/thumbnail.php"; ?>
			</td>
			<td><?=$value['index']?></td>
			<td>
				<?php include _template."/input/edit.php"; ?>
			</td>
			<td>
				<?php $disabled=""; include _template."/input/enable.php"; ?>
			</td>
			<td>
				<?php $disabled = checkAdmin($db) ? "" : "disabled"; include _template."/input/delete.php"; $disabled = ""; ?>
			</td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="10">
			<?php include _template."input/add.php"; ?>
			<?php $disabled = checkAdmin($db) ? "" : "disabled"; include _template."input/delall.php"; $disabled = ""; ?>
		</td>
	</tr>
	<?php if($pagination->count > 1) { ?>
	<tr>
		<td colspan="10">
			<?= $paging ?>
		</td>
	</tr>
	<?php } ?>
</table>

<style type="text/css">
.well {
	font-size: 30px;
	color: darkred;
	font-weight: bold;
	text-align: center;
}
.table th {
	text-align: center;
}

.table td {
	vertical-align: middle !important;
}
</style>
