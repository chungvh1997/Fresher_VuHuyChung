<div class="well">Cập nhật video</div>

<form action="" method="post" enctype="multipart/form-data">
	<table class="table">
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Video 1:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="video" id="video" rows="4" class="form-control" placeholder="Mã nhúng video 1"><?=$website['video']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Tiêu đề video 1:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vt" id="vt" rows="4" class="form-control" placeholder="Tiêu đề video 1"><?=$website['vt']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Nội dung video 1:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vn" id="vn" rows="4" class="form-control" placeholder="Nội dung video 1"><?=$website['vn']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Video 2:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="video2" id="video2" rows="4" class="form-control" placeholder="Mã nhúng video 2"><?=$website['video2']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Tiêu đề video 2:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vt2" id="vt2" rows="4" class="form-control" placeholder="Tiêu đề video 2"><?=$website['vt2']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Nội dung video 2:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vn2" id="vn2" rows="4" class="form-control" placeholder="Nội dung video 2"><?=$website['vn2']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Video 3:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="video3" id="video3" rows="4" class="form-control" placeholder="Mã nhúng video 3"><?=$website['video3']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Tiêu đề video 3:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vt3" id="vt3" rows="4" class="form-control" placeholder="Tiêu đề video 3"><?=$website['vt3']?></textarea>
		</td>
	</tr>
	<tr>
		<td class="col-xs-2">
			<label class="form-control">Nội dung video 3:</label>
		</td>
		<td class="col-xs-11">
			<textarea name="vn3" id="vn3" rows="4" class="form-control" placeholder="Nội dung video 3"><?=$website['vn3']?></textarea>
		</td>
	</tr>
	<tr>
		<tr>
			<td colspan="2" class="text-center">
				<button type="submit" name="videobtn" class="btn btn-success">Lưu lại</button>
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
</style>
