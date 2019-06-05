<a href="<?=@$disabled!=''?'javascript:void(0);':(str_replace("&act=list", "&act=edit", getCurrentPageURL()))?>&id=<?=$value['id']?>" class="btn btn-link" <?=@$disabled!='' ? "disabled" : ""?>><span class="glyphicon glyphicon-glyphicon glyphicon-edit"></span></a>

<style type="text/css">
	.glyphicon-edit {
		color: darkgreen;
	}
</style>
