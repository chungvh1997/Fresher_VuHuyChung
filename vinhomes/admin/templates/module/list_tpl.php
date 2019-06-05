<div class='well'>Danh sách mô-đun các nước</div>

<table class="table table-striped table-bordered text-center">
	<tr>
		<td class="text-left" colspan="15">
			<?php include _template."input/add.php"; ?>
		</td>
	</tr>
	<tr>
		<th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');" /></th>
		<th>STT</th>
		<th>Tiêu đề</th>
		<th>Sửa</th>
		<th>Hiển thị</th>
		<th>Xóa</th>
		<th>Nhân đôi</th>
	</tr>
	<?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
		<tr>
			<td>
				<?php $disabled = checkAdmin($db)?"":"disabled";     include _template."/input/checkbox.php"; $disabled = ""; ?>
			</td>
			<td><?=$u?></td>
			<td><?=$value['title']?></td>
			<td>
				<?php include _template."/input/edit.php"; ?>
			</td>
			<td>
				<?php include _template."/input/enable.php"; ?>
			</td>
			<td>
				<?php $disabled = checkAdmin($db)?"":"disabled"; include _template."/input/delete.php"; $disabled = ""; ?>
			</td>
			<td>
				<?php include _template."input/duplicate.php"; ?>
			</td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="15">
			<?php include _template."input/add.php"; ?>
			<?php $disabled = checkAdmin($db)?"":"disabled"; include _template."input/delall.php"; $disabled = ""; ?>
		</td>
	</tr>
	<?php if($pagination->count > 1) { ?>
		<tr>
			<td colspan="15">
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
