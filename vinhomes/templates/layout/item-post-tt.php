<div class="item-post-tt">
	<a href="">
		<img src="<?=$getPostItem['thumbnail'] ?>" alt="">
	</a>
	<p class="date-post">
		<?= str_replace("#","Tháng" , date("j # n, Y",$getPostItem['create_date'])) ?>
	</p>
	<h3 class="title-ttdt"><a href="<?= getURL($getPostItem['uri'])?>"><?= $getPostItem['title'] ?></a></h3>
	<div class="except-post"><?=mb_substr($getPostItem['description'],0,150,"utf-8")?>...</div>
</div>