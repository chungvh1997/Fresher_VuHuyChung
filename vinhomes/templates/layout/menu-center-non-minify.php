<?php
$row_home = $classify['home'];
$row_home_id = array();
foreach ($row_home as $r_home):
	$row_home_id[] = $r_home['id'];
endforeach;
?>
<div id="menu-center" class="hidden-xs">
	<div class="<?= $container ?> scrollfix">
		<div class="row menu-container">
			<?php foreach ($layout['center'] as $k_menu_center => $r_menu_center): ?>
				<?php $row_submenu_center = getItems(array( "table" => "product", "condition" => "where category_id like '{$r_menu_center['id']}' order by level desc, create_date desc" )) ?>
				<div class="item">
					<a href="<?= in_array($r_menu_center['id'], $row_home_id) ? (is_file("./home.php") ? "./index.php" : ".") : getURL($r_menu_center['uri']) ?>"><?= $r_menu_center['title'] ?></a>
					<?php if (is_array($row_submenu_center) && !empty($row_submenu_center)): ?>
						<div class="menu-subcontainer">
							<?php foreach ($row_submenu_center as $r_submenu_center): ?>
								<div class="subitem">
									<a href="<?= getURL($r_submenu_center['uri']) ?>"><?= $r_submenu_center['title'] ?></a>
								</div>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
				<?php if ($k_menu_center < count($row_menu_center) - 1): ?>
					<div class="line-vertical"></div>
				<?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
</div>
