<?php 
	$province = getItems(array("table" => "province", "id" => $post['province']));
	$share =  getItems(array("table" => "image", "condition" => "where type = 'share' and enable >0"));

 ?>
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
			<div class="clearfix" style="margin-bottom: 20px;"></div>
			<div class="top-job">
				<div class="logo-job">
					<img src="<?= $post['thumbnail'] ?>" alt="">
				</div>
				<div class="top-job-content">
					<h1>
						<?= $post['title'] ?>
					</h1>
					<b>Mã tuyển dụng: </b>
					<br>
					<b>Địa điểm làm việc: </b><?= $province['name'] ?>
				</div>
				<div class="nop-cv">
					<a href="mailto:<?=$information['email_receive']?>">Nộp CV<span></span></a>
				</div>
			</div>
			<div class="clearfix" style="margin-bottom: 20px;"></div>
			<div class="tuyen-dung-left">
				<div class="content-td">
					<?= $post['content'] ?>
				</div>
				<div class="after-content-job">
					<div class="nop-cv sad">
						<a href="mailto:<?=$information['email_receive']?>">Nộp CV<span></span></a>
					</div>
					<div class="share-job">
						<ul>
							<li>Chia sẻ:</li>
							<?php foreach ($share as $r_share): ?>
								<li>
									<a href="<?=$r_share['link']?>"> 
										<i class="<?=$r_share['font_awesome']?>"></i>
									</a>
								</li>
							<?php endforeach ?>
							
						</ul>
					</div>
				</div>
				
				<div class="clearfix" style="margin-bottom: 20px;"></div>
			</div>
			<div class="tuyen-dung-right">
				<div class="list-info-job">
					<?= $post['description'] ?>
				</div>
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