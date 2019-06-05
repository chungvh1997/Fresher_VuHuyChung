
<section id="tuyendung" class="tuyendung">
	<figure class="thubnail-td">
		<img src="<?= $r_category['thumbnail'] ?>" alt="">
		<div class="td">
			<div class="container event-thumbnail">
			<h4><?= $r_category['description'] ?></h4>
		</div>
		</div>
	</figure>

	<figure class="<?= $container ?>">
		<div class="row">
			<div class="search-tuyendung">
				<h1>Vị trí bạn đang quan tâm là gì?</h1>
				<form action="" method="get" id="form_td">
					<div>
						<input type="text" oninput="search_Td()" id="inp_td" name="search-td" placeholder="Nhân viên kinh doanh bất động sản" value="" class="form-control">
					</div>
					
				</form>
			</div>
			<div class="clearfix" style="margin-bottom: 20px;"></div>
			<div class="tuyen-dung-left">
				<h2 class="title-before">
					Vị trí tuyển dụng
				</h2>
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>Vị trí</th>
								<th>Mô tả</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($get_post_td as $r_post_td): ?>
								<tr class="product-search-td">
									<td>
										<a href="<?= $r_post_td['uri'] ?>"><?= $r_post_td['title'] ?></a>
									</td>
									<td style="padding-top: 10px;padding-bottom: 10px;">
										<?= $r_post_td['description'] ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="clearfix" style="margin-bottom: 20px;"></div>
			</div>
			<div class="tuyen-dung-right">
				<h2 class="title-before">
					Fanpage Tuyển dụng
				</h2>
				<div style="padding-left: 20px;padding-right: 20px;padding-bottom: 20px;">
					<?php include _template."layout/fanpage.php" ?>
				</div>
				
			</div>
			<div class="clearfix" style="margin-bottom: 20px;"></div>
		</div>
	</figure>
</section>
<script>
	function search_Td() {
		$.ajax({
			url: '<?=getAjaxURL()?>search_td.php',
			type: 'get',
			dataType: 'json',
			data: {
				lang: "<?= $_GET['lang'] ?>",
				keyword: $("#inp_td").val(), 
			},

			success:function(res){
				$("div.table").html(res.data);
			},
			error:function(err) {
				console.log(err);
			}
		});
	}
</script>