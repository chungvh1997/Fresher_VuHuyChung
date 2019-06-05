<div class="item-post-tt">
	<a href="">
		<img src="<?=$value['thumbnail'] ?>" alt="">
	</a>
	<p class="date-post">
		<?= str_replace("#","Tháng" , date("j # n, Y",$value['create_date'])) ?>
	</p>
	<h3 class="title-ttdt"><a href="<?= getURL($value['uri'])?>"><?= $value['title'] ?></a></h3>
	<div class="except-post"><?=mb_substr($value['description'],0,150,"utf-8")?>...</div>
</div>