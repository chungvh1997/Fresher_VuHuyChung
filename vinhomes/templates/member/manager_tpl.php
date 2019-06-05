<section id="content" class="container-fluid">
	<div class="text-center"><span class="title label label-info">Quản lý tin đăng</span></div>
	<?php if(count($row_product) > 0): ?>
		<table class="table table-bordered table-striped">
			<tr>
				<th>STT</th>
				<th class="mobile-hidden">Mã sản phẩm</th>
				<th>Tiêu đề</th>
				<th class="mobile-hidden">Ảnh đại diện</th>
				<th>Ngày đăng</th>
				<th>Trạng thái</th>
				<th>Sửa</th>
				<th>Xóa</th>
			</tr>
			<?php foreach($row_product as $k_product => $r_product): ?>
				<tr>
					<td><?= ($pagination->current-1)*$pagination->max_item + $k_product + 1 ?></td>
					<td class="mobile-hidden"><?= $r_product['serial'] ?></td>
					<td><a href="<?= getURL($r_product['uri']) ?>" title="Xem chi tiết" target="_blank"><?= $r_product['title'] ?></a></td>
					<td class="mobile-hidden text-center"><?php if(@$r_product['thumbnail'] != ""): ?><img src="<?= $r_product['thumbnail'] ?>" alt="<?= $r_product['title'] ?>" style="width:100px;"><?php else: ?>...<?php endif; ?></td>
					<td><?= date("d/m/Y H:i:s", $r_product['create_date']) ?></td>
					<td><?= in_array(@$r_product['enable'], array(null, 0)) ? "Đang chờ duyệt" : "Đã duyệt!" ?></td>
					<td style="width: 30px; text-align: center;"><a href="<?= getURL("member/edit/{$r_product['id']}") ?>"><i class="fa fa-edit"></i></a></td>
					<td style="width: 30px; text-align: center;"><a href="javascript:void(0);" class="remove_product" data-url="<?= getURL("member/delete/{$r_product['id']}") ?>"><i class="fa fa-trash-alt"></i></a></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="10">
          <div class="clear"></div>
					<?= $pagination->getSource(); ?>
				</td>
			</tr>
		</table>
	<?php else: ?>
		<div class="text-danger text-center" style="font-weight: 500; font-size: 18px; margin-bottom: 20px; line-height: 100px;">
			Không có tin đăng.
		</div>
	<?php endif; ?>
	<div class="text-center"><a class="btn btn-success btn-lg" href="<?= getURL("member/submit") ?>">Đăng tin mới</a></div>
</section>

<script type="text/javascript">
	$(document).ready(function () {
		$(".remove_product").click(function (e) {
			if(confirm("Bạn chắc chắn muốn xóa?"))
				window.location = $(this).data("url");
		});
	});
</script>
<style type="text/css">
	#content {
		margin-top: 30px;
		margin-bottom: 30px;
	}
	#content .title {
		display: inline-block;
		font-size: 26px;
		padding: 10px 20px;
		margin-bottom: 20px;
	}
	@media screen and (max-width: 767px) {
		.mobile-hidden {
			display: none !important;
		}
	}
</style>