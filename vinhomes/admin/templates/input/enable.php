<?php $enable = $value['enable'] ? 0 : 1; ?>
<button onclick="<?=@$disabled!=""?"javascript:void(0);":"update('{$table}', '{$value['id']}', 'enable', $(this).data('value'), $(this));"?>" data-value="<?= $enable ?>" class="btn btn-link" <?=@$disabled!='' ? "disabled" : ""?>><span class="glyphicon glyphicon-glyphicon glyphicon-<?=$value['enable']?'ok':'remove'?>"></span></button>

<style type="text/css">
	.glyphicon-ok {
		color: darkgreen;
	}
	.glyphicon-remove {
		color: darkred;
	}
</style>