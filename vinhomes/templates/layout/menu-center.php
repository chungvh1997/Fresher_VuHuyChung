<?php
$row_home = $classify['home'];
$row_home_id = array();
foreach ($row_home as $r_home):
	$row_home_id[] = $r_home['id'];
endforeach;
$data = getItems(array("table" => "website"));
?>
<div id="menu-center" class="hidden-xs">
	<div class="<?= $container ?> ">
		<div class="logo">
			<h1 class="img-logo">
				<a href=".">
					<img src="<?php foreach ($data as $value): ?>
						<?= $value['favicon'] ?>
					<?php endforeach ?>" alt="" >
				</a>
			</h1>
		</div>
		<div class="row menu-container">
			<?php foreach ($layout['center'] as $k_menu_center => $r_menu_center): ?>
				<?php $row_submenu_center = getItems(array( "table" => "product", "condition" => "where category_id like '{$r_menu_center['id']}' order by level desc, create_date desc" )) ?>
				<div class="item">
					<a href="<?= in_array($r_menu_center['id'], $row_home_id) ? (is_file("./home.php") ? "./index.php" : ".") : getURL($r_menu_center['uri']) ?>"><?= $r_menu_center['title'] ?></a>
				<!-- 	<?php if (is_array($row_submenu_center) && !empty($row_submenu_center)): ?>
						<div class="menu-subcontainer">
							<?php foreach ($row_submenu_center as $r_submenu_center): ?>
								<div class="subitem">
									<a href="<?= getURL($r_submenu_center['uri']) ?>"><?= $r_submenu_center['title'] ?></a>
								</div>
							<?php endforeach ?>
						</div>
					<?php endif ?> -->
				</div>
				<?php if ($k_menu_center < count($row_menu_center) - 1): ?>
					<div class="line-vertical"></div>
				<?php endif ?>
			<?php endforeach ?>
		</div>
		<div class="language-search">
			<ul style="text-align: right;padding-top: 40px;padding-left: 15px;padding-right: 15px;">
				<li id="language">
					<select name="language" onchange="window.location= this.value;">
						<?php $row_language = getItems(array("table" => "language", "condition" => "where  enable>0 ")) ?>
						<?php foreach ($row_language as $value) { ?>
							<option value="<?= getURL($value['uri'],false,false) ?>" <?=$lang['id']==$value['id']?selected:""?> ><?= $value['title'] ?></option>
						<?php } ?>
					</select>
				</li>
				<li id="search-top">
					<div id="btn-search">
						<i class="fas fa-search"></i>
					</div>
				</li>
			</ul>
		</div>
		<div id="form-search" style="height: 86px;">
			<form action="<?=getURL($classify['search'][0]['uri']) ?>" class="searchbox search" id="sreachform" method="post">
				<input type="search" placeholder="Tìm kiếm..." name="q" class="searchbox-input" >
				<input type="submit" name="search" class="submit">
				<button type="button"  id="btn-close">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
			</form>
		</div>
		
	</div>
</div>

<script >
	$(document).ready(function(){
		$("#btn-search").click(function() {
			$("#form-search").addClass('open');
			$(".searchbox.search").addClass('searchbox-open');
		});
		$("#btn-close").click(function() {
			$("#form-search").removeClass('open');
			$(".searchbox.search").removeClass('searchbox-open');
		});
	});
</script>