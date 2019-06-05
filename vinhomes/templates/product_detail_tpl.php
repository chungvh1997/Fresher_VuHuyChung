<?php 
	$data = getItems(array("table" => "product_image" , "condition" => "where product_id = {$product['id']}"));
	$data2 = getItems(array("table" => "product_tab" , "condition" => "where product_id = {$product['id']}"));
?>
<div id="content-product-img">
	<div id="product-thumbnail" class="swiper-container replaced" data-loop="false" data-touch="false" data-view="1">
		<div class="swiper-wrapper">
			<?php foreach ($data as $value): ?>
				<div class="swiper-slide">
					<img src="<?= $value['thumbnail'] ?>">
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="title-thumbnail">
		<?= $product['title'] ?>
	</div>
</div>

<section id="content-product-detail" class="product">
	<div class="menu-project-container">
		<div class="menu-project">
			<div class="container">
				<div class="row">
					<ul>
						<li>
							<a href="#noidung-gioithieu" class="tab-link "><?=$lang['column_27']?></a>
						</li>
						<?php foreach ($data2 as $value): ?>
							<li>
								<a href="#noidung-<?=$value['id']?>" class="tab-link"><?=$value['title']?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div id="content-gioi-thieu">
		<div class="container bao" id="noidung-gioithieu">
			<div class="row">
				<h2 class="title-before"><?=$lang['column_27']?></h2>
				<?= $product['content'] ?>
			</div>
		</div>
	</div>
	<?php foreach ($data2 as $val): ?>
		<div id="content-gioi-thieu">
			<div class="container bao" id="noidung-<?=$val['id']?>">
				<div class="row">
					<h2 class="title-before"><?=$val['title']?></h2>
					<?= $val['content'] ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	
	<div class="container">
		<div class="row">
			<div id="dky-baogia" style="margin-bottom: 30px;">
				<?php include _template."layout/register.php" ?>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){

		$(document).scroll(function(){

			var top = $(this).scrollTop();
			var container = $('.menu-project-container');
			var menu = $('.menu-project');
			container.css("height",menu.outerHeight()+"px");
			if (top  >= container.offset().top) {
				if (!menu.hasClass("fixed")) {
					menu.addClass('fixed');
				}
			}
			else{
				menu.removeClass("fixed");
			}
			$(".tab-link").each(function() {
				var target = $($(this).attr("href"));
				
				if (top >= target.offset().top - $('.menu-project-container').outerHeight()-15 && top < target.offset().top+target.outerHeight()-$('.menu-project-container').outerHeight()-15) {
					
					$(this).addClass('active');
				}
				else{

					$(this).removeClass('active');
				}
			});
		});
			$(".tab-link").click(function(e){
				//console.log($(this).attr("href"));
				 e.preventDefault();
				 var top = $($(this).attr("href")).offset().top - $('.menu-project-container').outerHeight()-10;
			 $('html,body').animate({scrollTop:top},1000);

		})


	});
</script>
<style>
	.menu-project.fixed{
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		z-index: 9999;
	}
	.menu-project{
		background-color: #fff;
		box-shadow: 0 0 3px black;
		font-weight: bold;
		
	}
</style>