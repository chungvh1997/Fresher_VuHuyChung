<div class="well"><?=$title?></div>

<form action="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=save", getCurrentPageURL()))?>" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
	<table class="table">
		<tr>
			<td colspan="2" class="text-left">
				<input name="id" type="hidden" value="<?=@$item['id']?>">
				<input name="type" type="hidden" value="<?=$type?>">
				<input name="savebtn" type="submit" class="btn btn-success" value="Lưu lại">
				<a href="<?=preg_replace('/(&id=\d*)/', '', str_replace("&act=edit", "&act=list", getCurrentPageURL()))?>" class="btn btn-danger">Hủy</a>
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Danh mục cha:</label></td>
			<td class="col-xs-10">
				<select id="parent_id" name="parent_id" class="form-control" title="Danh mục cha của danh mục này">
					<option value="0">-- Đây là danh mục cha --</option>
					<?php
					foreach ($row_category as $value) {
						$tmp = explode(" / ", getCategoryPath($value['id']));
						array_pop($tmp);
						$tmp = implode(" / ", $tmp);
						?>
						<option value="<?=$value['id']?>" <?=$value['id']==@$item['parent_id'] ? "selected" : ""?>>
							<?= $value['title'] ?><?= $tmp!="" ? "&nbsp;&nbsp;&nbsp;({$tmp})" : "" ?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<!-- <tr>
			<td class="col-xs-2"><label class="form-control">Mô-đun:</label></td>
			<td class="col-xs-10">
				<select id="module_id" name="module_id" class="form-control" title="Danh mục cha của danh mục này">
					<option value="0">-- Đây là danh mục cha --</option>
					<?php
					foreach ($row_module as $value) {
						?>
						<option value="<?=$value['id']?>" <?=$value['id']==@$item['module_id'] ? "selected" : ""?>>
							<?=$value['title']?>
						</option>
						<?php
					}
					?>
				</select>
			</td>
		</tr> -->
		<tr>
			<td class="col-xs-2"><label class="form-control">Hình hiện tại:</label></td>
			<td class="col-xs-10">
				<img id="thumb" src="<?=$item['thumbnail']!=''?(count(explode("://", $item['thumbnail']))>1?$item['thumbnail']:str_replace("//", "/", $item['thumbnail'])):''?>" alt="Chưa có hình đại diện" onclick="openBrowser('#thumb', '#thumbnail');" style="cursor: pointer;">&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-primary" onclick="openBrowser('#thumb', '#thumbnail');">Chọn hình</button>&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-danger" onclick="$('#thumbnail').val('');$('#thumb').attr('src','');">Xóa hình hiện tại</button>
				<input id="thumbnail" name="thumbnail" type="hidden" value="<?=$item['thumbnail']?>">
			</td>
		</tr>
		<tr>
			<td class="col-xs-2"><label class="form-control">Đường dẫn khác:</label></td>
			<td class="col-xs-10">
				<input name="url" type="text" class="form-control" placeholder="Nhập đường dẫn khác cho hình ảnh" title="Đường dẫn cố định cho hình ảnh">
			</td>
		</tr>
		<!-- <tr>
			<td class="col-xs-2"><label class="form-control">Đường dẫn cố định (nếu có):</label></td>
			<td class="col-xs-10">
				<input name="link" type="text" class="form-control" placeholder="Nhập đường dẫn cố định" value="<?= @$item['uri'] ?>">
			</td>
		</tr> -->
		<!-- <tr>
			<td class="col-xs-2"><label class="form-control">Thứ tự hiển thị:</label></td>
			<td class="col-xs-10">
				<input name="index" type="number" min="0" max="10000" class="form-control" placeholder="Nhập thứ tự" title="Thứ tự hiển thị trên trang chủ" value="<?=@$item!="" ? $item['index'] : "0"?>">
			</td>
		</tr> -->
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
							<input name="title_<?=$r_language['uri']?>" type="text" class="form-control required" placeholder="Nhập tiêu đề <?=$r_language['title']?>" title="Tiêu đề danh mục <?=$r_language['title']?>" value="<?=@$item['title']?>" autofocus>
						</td>
					</tr>
					<?php if($type == "page"): ?>
						<tr>
							<td class="col-xs-2">
								<label class="form-control">Tiêu đề trong trang:</label>
							</td>
							<td class="col-xs-10">
								<input name="first_tag_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập tiêu đề trong trang" title="Tiêu đề <?=$r_language['title']?> hiển thị trong chi tiết trang của danh mục" value="<?=@$item['first_tag']?>">
							</td>
						</tr>
					<?php endif; ?>
					<tr>
						<td class="col-xs-2">
							<label class="form-control">Mô tả:</label>
						</td>
						<td class="col-xs-10">
							<textarea id="description_<?=$r_language['uri']?>" name="description_<?=$r_language['uri']?>" class="editor"><?=$item['description']?></textarea>
						</td>
					</tr>
					<?php if ($type == "page"): ?>
						<tr>
							<td class="col-xs-2">
								<label class="form-control">Nội dung:</label>
							</td>
							<td class="col-xs-10">
								<textarea id="content_<?=$r_language['uri']?>" name="content_<?=$r_language['uri']?>" class="editor"><?=$item['content']?></textarea>
							</td>
						</tr>
					<?php endif ?>
					<tr>
						<td class="col-xs-2"><label class="form-control">Keyword:</label></td>
						<td class="col-xs-10">
							<input name="keyword_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập keyword" title="Keyword <?=$r_language['title']?> có chức năng tăng mức độ SEO" value="<?=@$item['keyword']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">Description:</label></td>
						<td class="col-xs-10">
							<input name="desc_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập description" title="Description <?=$r_language['title']?> có chức năng tăng mức độ SEO" value="<?=@$item['desc']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H1:</label></td>
						<td class="col-xs-10">
							<input name="h1_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H1" title="H1, H2, H3 <?=$r_language['title']?> có chức năng tăng mức độ SEO" value="<?=@$item['h1']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H2:</label></td>
						<td class="col-xs-10">
							<input name="h2_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H2" title="H1, H2, H3 <?=$r_language['title']?> có chức năng tăng mức độ SEO" value="<?=@$item['h2']?>">
						</td>
					</tr>
					<tr>
						<td class="col-xs-2"><label class="form-control">H3:</label></td>
						<td class="col-xs-10">
							<input name="h3_<?=$r_language['uri']?>" type="text" class="form-control" placeholder="Nhập H3" title="H1, H2, H3 <?=$r_language['title']?> có chức năng tăng mức độ SEO" value="<?=@$item['h3']?>">
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
