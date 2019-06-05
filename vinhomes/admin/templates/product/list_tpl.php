<div class="well">Danh sách sản phẩm (<?=$pagination->count_item?>)</div>

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
					<option value="">-- Danh mục --</option>
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
		<!-- <th>Mã sản phẩm</th> -->
		<th>Tiêu đề</th>
		<th>Ảnh đại diện</th>
		<th>Đường dẫn</th>
		<th>Danh mục sản phẩm</th>
		<th>Danh mục dự án</th>
		<th>Danh sách ảnh</th>
		<th>Danh sách thẻ</th>
		<th>Độ ưu tiên</th>
		<th>Sửa</th>
		<th>Hiển thị</th>
		<!-- <th>SP mới</th> -->
		<th><?= $lang['column_7'] ?></th>
		<!-- <th>SP khuyến mãi</th> -->
		<th>Xóa</th>
		<th>Nhân đôi</th>
	</tr>
	<?php $u=($pagination->current-1)*$pagination->max_item; foreach ($items as $value) { $u++; ?>
		<tr>
			<td>
				<?php include _template."input/checkbox.php"; ?>
			</td>
			<td><?=$u?></td>
			<!-- <td><?=$value['serial']?></td> -->
			<td><?=$value['title']?></td>
			<td>
				<?php include _template."input/thumbnail.php"; ?>
			</td>
			<td>
				<?php
				$url = getURL($value['uri'], true);
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
						echo getCategoryPath($value['category_id']);
					else
						echo '<b class="text-danger">Đã xóa danh mục!</b>';
				else:
					echo "...";
				endif;
				?>
			</td>
			<td>
				<?php
				if(@$value['project_id']!=""):
					$ptitle = getTranslate("category", $row_language[0]['id'], $value['project_id']);
					if(is_array($ptitle) && !empty($ptitle))
						echo getCategoryPath($value['project_id']);
					else
						echo '<b class="text-danger">Đã xóa danh mục!</b>';
				else:
					echo "...";
				endif;
				?>
			</td>
			<!-- <td>
				<?php
				if(@$value['brand_id']!=""):
					$ptitle = getTranslate("category", $row_language[0]['id'], $value['brand_id']);
					if(is_array($ptitle) && !empty($ptitle))
						echo getCategoryPath($value['brand_id']);
					else
						echo '<b class="text-danger">Đã xóa danh mục!</b>';
				else:
					echo "...";
				endif;
				?>
			</td> -->
			<td>
				<?php
				$url = "index.php?com=product-image&act=list&product_id=".$value['id'];
				$text = "Xem ảnh";
				$current_page = true;
				include _template."input/link.php";
				?>
			</td>
			<td>
				<?php
				$url = "index.php?com=product-tab&act=list&product_id=".$value['id'];
				$text = "Xem thẻ";
				$current_page = true;
				include _template."input/link.php";
				?>
			</td>
			<td><?=$value['level']?></td>
			<td>
				<?php include _template."input/edit.php"; ?>
			</td>
			<td>
				<?php include _template."input/enable.php"; ?>
			</td>
			<!-- <td>
				<?php $column="new"; include _template."input/popular.php"; ?>
			</td> -->
			<td>
				<?php $column="popular"; include _template."input/popular.php"; ?>
			</td>
			<!-- <td>
				<?php $column="promotion"; include _template."input/popular.php"; ?>
			</td> -->
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
