<?php
$row_home = $classify['home'];
$row_home_id = array();
foreach ($row_home as $r_home):
	$row_home_id[] = $r_home['id'];
endforeach;
?>
<div id="menu-mobile" class="visible-xs">
	<div class="menu-mobile-navigation">
		<a href="#menu-mobile-container" class="btn">
			<i class="fa fa-bars"></i>
		</a>
		<span class="slogan"><b><?= $information['slogan'] ?></b></span>
		<div class="clearfix"></div>
	</div>
	<nav id="menu-mobile-container">
		<ul>
			<li><a href="<?= is_file("./home.php") ? "./index.php" : "." ?>">
				<span class="fa fa-home"></span>
			</a></li>
			<?php foreach ($layout['top'] as $r_menu_top): ?>
				<li><a href="<?= getURL($r_menu_top['uri']) ?>"><?= $r_menu_top['title'] ?></a></li>
			<?php endforeach ?>
			<?php foreach ($layout['center'] as $r_menu_center): if(in_array($r_menu_center['id'], $row_home_id)) continue; ?>
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
		</ul>
	</nav>
</div>