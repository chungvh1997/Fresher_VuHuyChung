<button onclick="<?=@$disabled!=""?"javascript:void(0);":"update('{$table}', '{$value['id']}', 'delete', null);"?>" class="btn btn-link" <?=@$disabled!='' ? "disabled" : ""?>><span class="glyphicon glyphicon-glyphicon glyphicon-trash"></span></button>

<style type="text/css">
	.glyphicon-trash {
		color: darkred;
	}
</style>