<div id="menu-top" class="hidden-xs"><div class="<?=$container?>"><div class="row item-container menu-left"><div class="item"><b><?=$information['slogan']?></b></div></div><div class="row item-container menu-right"><?php foreach($layout['top'] as $r_menu_top):?><a href="<?=getURL($r_menu_top['uri'])?>" class="item"><?=$r_menu_top['title']?></a><?php endforeach?></div></div></div>