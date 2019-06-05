<div class="well">Danh sách bài viết (<?=$pagination->count_item?>)</div>

<table class="table table-striped table-bordered text-center">
	<tr>
		<td class="text-left" colspan="20">
			<?php include _template."input/add.php"; ?>
		</td>
	</tr>
	<tr>
		<td colspan="20" class="text-left">
			<form method="post" onsubmit="getFilter('<?=$filterStr?>'); return false;">
				&nbsp;&nbsp;&nbsp;<span class="text-muted">Lọc theo:</span>&nbsp;&nbsp;
				<input id="title" type="text" class="filter form-control" placeholder="Từ khóa" style="width: auto; display: inline-block; background: white;" autofocus value="<?=@$_SESSION[$filterStr]['title']?>">
				<select id="category_id" class="filter form-control" style="width: auto; display: inline-block; background: white;" onchange="getFilter('<?=$filterStr?>');">
					<option value="">-- Danh mục bài viết --</option>
					<?php foreach ($filter_items as $fi): ?>
						<option value="<?=$fi['id']?>" <?=$fi['id']==@$_SESSION[$filterStr]['category_id'] ? "selected" : ""?>><?=$fi['title']?></option>
					<?php endforeach ?>
				</select>
				<button type="submit" class="btn btn-success" style="margin-top: -3px;">Lọc</button>
				<button class="btn btn-danger" onclick="$('.filter').val(''); getFilter('<?=$filterStr?>');" style="margin-top: -3px;">Xóa lọc</button>
			</form>
		</td>
	</tr>
	<tr>
		<th><input class="selallbox" type="checkbox" onclick="$('.selbox').trigger('click');" /></th>
		<th>STT</th>
		<th>Tiêu đề</th>
		<th>Ảnh đại diện</th>
		<th>Đường dẫn</th>
		<th>Danh mục bài viết</th>
		<th>Độ ưu tiên</th>
		<th>Sửa</th>
		<th>Hiển thị</th>
		 <th>Nổi bật</th>
		<th>Xóa</th>
		<th>Nhân đôi</th>
	</tr>
	<?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
		<tr>
			<td>
				<?php include _template."input/checkbox.php"; ?>
			</td>
			<td><?=$u?></td>
			<td><?=$value['title']?></td>
			<td>
				<?php include _template."input/thumbnail.php"; ?>
			</td>
			<td>
				<?php
				$url = $value['link']!="" ? $value['link'] : getURL($value['uri'], true);
				$text = "Liên kết";
				$current_page = false;
				include _template."input/link.php";
				?>
			</td>
			<td>
				<?php
				if(@$value['category_id']!=""):
					$ptitle = getTranslate("category", $row_language[0]['id'], $value['category_id']);
					if(is_array($ptitle) && !empty($ptitle))
						echo $ptitle['title'];
					else
						echo '<b class="text-danger">Đã xóa danh mục!</b>';
				else:
					echo "...";
				endif;
				?>
			</td>
			<td><?=$value['level']?></td>
			<td>
				<?php include _template."input/edit.php"; ?>
			</td>
			<td>
				<?php include _template."input/enable.php"; ?>
			</td>
			<td>
				<?php include _template."input/popular.php"; ?>
			</td>
			<td>
				<?php include _template."input/delete.php"; ?>
			</td>
			<td>
				<?php include _template."input/duplicate.php"; ?>
			</td>
		</tr>
	<?php } ?>
	<tr>
		<td colspan="20">
			<?php include _template."input/add.php"; ?>
			<?php include _template."input/delall.php"; ?>
		</td>
	</tr>
	<?php if($pagination->count > 1) { ?>
	<tr>
		<td colspan="20">
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
.table td[colspan='20'] {
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
