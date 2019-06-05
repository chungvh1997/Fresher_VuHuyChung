<div class="well">Danh sách hình ảnh sản phẩm '<?=@$category['title']?>' (<?=$pagination->count_item?>)</div>

<table class="table table-striped table-bordered text-center">
	<tr>
		<td class="text-left" colspan="14">
			<?php include _template."input/add.php"; ?>
			<?php
				$backUrl=preg_replace('(&category_id=\d*)', "", str_replace("?com=category-image", "?com=category", getCurrentPageURL()));
				include _template."input/back.php";
			?>
		</td>
	</tr>
	<tr>
		<th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');" /></th>
		<th>STT</th>
		<th>Hình ảnh</th>
		<th>Thứ tự hiển thị</th>
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
			<td>
				<?php include _template."input/thumbnail.php"; ?>
			</td>
			<td><?=$value['index']?></td>
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
			<?php
				$backUrl=preg_replace('(&category_id=\d*)', "", str_replace("?com=category-image", "?com=category", getCurrentPageURL()));
				include _template."input/back.php";
			?>
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
