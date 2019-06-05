<div class="well">Thêm/Cập nhật mô-đun các nước '<?= $item['title'] ?>'</div>

<form action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="id" type="hidden" value="<?=@$item['id']?>">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Trạng thái hiển thị:</label></td>
			<td class="col-xs-10">
				<select name="enable" class="form-control" title="Cho phép hiển thị và truy cập vào sản phẩm">
					<option value="1"<?=in_array($item['enable'], array(NULL, 1))?" selected":""?>>Có</option>
					<option value="0"<?=!in_array($item['enable'], array(NULL, 1))?" selected":""?>>Không</option>
				</select>
			</td>
		</tr>
	</table>
	<ul class="nav nav-tabs" role="tablist">
		<?php foreach($row_language as $k_language => $r_language): ?>
			<li role="presentation" <?= $k_language==0 ? 'class="active"' : "" ?>>
				<a href="#<?= $r_language['uri'] ?>" aria-controls="<?= $r_language['uri'] ?>" role="tab" data-toggle="tab">
					<img src="<?= $r_language['thumbnail'] ?>" style="height: 30px;">
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="tab-content">
		<?php foreach($row_language as $k_language => $r_language): $item = $row_translate[$k_language]; ?>
			<div id="<?= $r_language['uri'] ?>" role="tabpanel" class="tab-pane fade <?= $k_language==0 ? "in active" : "" ?>">
				<table class="table">
					<tr>
						<td class="col-xs-2"><label class="form-control">Tiêu đề:</label></td>
						<td class="col-xs-10">
							<input name="title_<?=$r_language['uri']?>" type="text" class="form-control required" placeholder="Nhập tiêu đề" title="Tiêu đề <?= $r_language['title'] ?> của danh mục" value="<?=@$item['title']?>" autofocus>
						</td>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>
	</div>
	<table class="table">
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
