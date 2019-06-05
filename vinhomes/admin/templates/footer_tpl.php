<div class="well">Cập nhật thông tin footer</div>

<form action="" method="post" enctype="multipart/form-data">
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
		<?php foreach($row_language as $k_language => $r_language): $item = $items[$k_language]; ?>
			<div id="<?= $r_language['uri'] ?>" role="tabpanel" class="tab-pane fade <?= $k_language==0 ? "in active" : "" ?>">
				<table class="table">
					<tr>
						<td colspan="2" class="text-center">
							<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
							<input name="id_<?=$r_language['uri']?>" type="hidden" value="<?=@$item['id']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Footer:</label></td>
						<td class="col-xs-10">
							<textarea id="information_<?=$r_language['uri']?>" name="information_<?=$r_language['uri']?>" class="editor"><?=$item['information']?></textarea>
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Copyright:</label></td>
						<td class="col-xs-10">
							<textarea id="copyright" name="copyright_<?=$r_language['uri']?>" class="editor"><?=$item['copyright']?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="text-center">
							<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
						</td>
					</tr>
				</table>
			</div>
		<?php endforeach; ?>
	</div>
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
.table td img {
	max-width: 100%;
	max-height: 100px;
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
