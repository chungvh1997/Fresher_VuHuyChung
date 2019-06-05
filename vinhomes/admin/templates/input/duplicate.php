<button onclick="<?=@$disabled!=""?"javascript:void(0);":"duplicate('{$table}', '{$value['id']}');"?>" class="btn btn-link" <?=@$disabled!='' ? "disabled" : ""?>><span class="glyphicon glyphicon-glyphicon glyphicon-duplicate"></span></button>

<style type="text/css">
	.glyphicon-duplicate {
		color: darkblue;
	}
</style>