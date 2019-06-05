<?php
if(@$column == "")
	$column = "popular";
$popular = $value[$column] ? 0 : 1;
?>
<button onclick="<?=@$disabled!=""?"javascript:void(0);":"update('{$table}', '{$value['id']}', '{$column}', $(this).data('value'), $(this));"?>" data-value="<?= $popular ?>" class="btn btn-link" <?=@$disabled!='' ? "disabled" : ""?>><span class="glyphicon glyphicon-glyphicon glyphicon-<?=$value[$column]?'ok':'remove'?>"></span></button>

<style type="text/css">
	.glyphicon-ok {
		color: darkgreen;
	}
	.glyphicon-remove {
		color: darkred;
	}
</style>