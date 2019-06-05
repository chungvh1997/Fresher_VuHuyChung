<?php
$row_home = $classify['home'];
$row_home_id = array();
foreach ($row_home as $r_home):
	$row_home_id[] = $r_home['id'];
endforeach;

?>


<div id="menu-mobile" class="visible-xs" style="background-color: #fff;">
	<div class="menu-mobile-navigation">
		<div class="col-xs-3" style="padding-top: 10px;">
			<a href="#menu-mobile-container" class="btn">
				<i class="fa fa-bars" style="font-size: 20px;color: #73716A;"></i>
			</a>
		</div>
		<div class="col-xs-6" style="text-align: center;">
			<a href=""><img src="<?= $information['favicon'] ?>" alt="" style="height: 50px;"></a>
		</div>
		<div class="col-xs-3" style="text-align: right;">
			<div id="btn-search-moblie" style="padding-top: 10px;">
				<i class="fas fa-search" style="font-size: 20px;color: #73716A;"></i>
			</div>
		</div>
		<div class="clearfix"></div>

			<div id="form-search_mobile" class="form_mobile_search" style="height: 71px;width: 100%;padding-top: 11px;">
				<form action="<?=getURL($classify['search'][0]['uri']) ?>" class="search_mobile" id="search_mobile" method="post">
					<input type="search" placeholder="Tìm kiếm..." name="q" class="search_mobile-input" >
					<input type="submit" name="search" class="submit">
					<button type="button"  id="btn-close_mobile">
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
				</form>
			</div>

	</div>
	<nav id="menu-mobile-container">
	<ul>
			<li><a href="<?= is_file("./home.php") ? "./index.php" : "." ?>">
				<span >Trang chủ</span>
			</a></li>

		<!-- 	<?php foreach ($layout['top'] as $r_menu_top): ?>
				<li><a href="<?= getURL($r_menu_top['uri']) ?>"><?= $r_menu_top['title'] ?></a></li>
			<?php endforeach ?> -->
			<?php foreach ($layout['top'] as $r_menu_center): if(in_array($r_menu_center['id'], $row_home_id)) continue; ?>
				<?php $row_submenu_center = getItems(array("table" => "product", "condition" => "where category_id like '{$r_menu_center['id']}' order by level desc, create_date desc")) ?>
				<li>
					<a href="<?= getURL($r_menu_center['uri']) ?>"><?= $r_menu_center['title'] ?></a>
					<?php if (is_array($row_submenu_center) && !empty($row_submenu_center)): ?>
						<ul>
							<?php foreach ($row_submenu_center as $r_submenu_center): ?>
								<li><a href="<?= $r_submenu_center['uri'] ?>"><?= $r_submenu_center['title'] ?></a></li>
							<?php endforeach ?>
						</ul>
					<?php endif ?>
				</li>
			<?php endforeach; ?>
			<?php $row_language = getItems(array("table" => "language", "condition" => "where  enable>0 ")) ?>
			<?php foreach ($row_language as $value) { ?>
				<li><a href="<?= getURL($value['uri'],false,false) ?>"><img src="<?=$value['thumbnail']?>" alt=""></a></li>
			<?php } ?>
		</ul>

	</nav>
	
</div>
<style>
	#form-search_mobile{display: none;}
	#form-search_mobile{position: absolute;top: 0;width: 0;height: 110px;background: rgba(255, 255, 255, 1);float: right;
	}
	#form-search_mobile{width: 100%;left: 0;}
	.search_mobile {position: relative;width: calc(100% - 20px);height: 50px;overflow: hidden;-webkit-transition: width 0.5s;-moz-transition: width 0.5s;-ms-transition: width 0.5s;-o-transition: width 0.5s;transition: width 0.5s;margin: auto;
	}
	.search_mobile-open {width: 80%;left: -10%;border: 1px solid #eee;
	}
	.search_mobile-input {top: 0;right: 0;border: 1px solid #EEEEEE;;outline: 0;background: #fff;height: 50px;margin: 0;padding: 0 20px;font-size: 20px;color: #6f6f6f;width: 100%;border-radius: 0;
	}
	#btn-close_mobile{position: absolute;top: 50%;transform: translateY(-50%);right: 10px;background: none;border: none;
	}
	#btn-close_mobile .icon-bar{display: block;width: 20px;height: 2px;margin: 8px 0px;border-radius: 1px;background: #919191;
	}
	#btn-close_mobile .icon-bar:nth-child(1){transform: translateY(4.6px) rotate(45deg)}
	#btn-close_mobile .icon-bar:nth-child(2){transform: translateY(-5.5px) rotate(-45deg)}
	.open_mobile{display: block!important;}
	#menu-mobile-container{width: 100%!important;max-width: unset!important;}
	.mm-wrapper_opening .mm-menu_offcanvas.mm-menu_opened~.mm-slideout{transform: translate(0);}
	.mm-menu.mm-current{height: 500px!important;}
	nav#menu-mobile-container{top: 70px;z-index: 9999999;transition: transform .5s;transform: translateY(calc(-100% - 70px));}
	#menu-mobile{position: fixed;top: 0;z-index: 99999999;left: 0;width: 100%;}
	html.mm-wrapper_opened #menu-mobile .fa:before{content: "\f00d";}
	html.mm-wrapper_opened nav#menu-mobile-container{transform: translateY(0)!important;}
	.mm-menu_offcanvas{display: block!important;}
	html:not(.wrapper_opening) nav#menu-mobile-container{transform: translateY(calc(-100% - 70px));}
	div#mm-1, .mm-panel_has-navbar .mm-navbar, div#mm-2, div#mm-3{background-color: #fff;}
	.mm-panels .mm-panel ul li a:hover{color: #cc9036;  }
	.mm-panels .mm-panel ul li a , .mm-panels .mm-panel ul li a span{font-size: 14px;text-transform: uppercase;font-weight: 400;font-family: Arial;}

	.mm-listitem:nth-last-child(1), .mm-listitem:nth-last-child(2){display: inline-block; } 
	.mm-listitem:nth-last-child(1):after, .mm-listitem:nth-last-child(2):after{border-bottom-style: unset;}
	.mm-listitem:nth-last-child(1) a{padding-left: unset;}
</style>

<script >
	$(document).ready(function(){
		$("#btn-search-moblie").click(function() {
			$(".form_mobile_search").addClass("open_mobile");
		});
		$("#btn-close_mobile").click(function() {
			$(".form_mobile_search").removeClass("open_mobile");
		});
	


	});
	
</script>