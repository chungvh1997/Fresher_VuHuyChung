<?php
session_start();
@define ( '_template' , '../../templates/');
@define ( '_source' , '../../sources/');
@define ( '_lib' , '../../lib/');
include_once _lib."config.php";
include_once _lib."class.database.php";
include_once _lib."functions.php";
$db = new database($config['database']);
$logged = @$_COOKIE['user']['username'] != "";
if(!$logged)
		redirect("404.html");
else {
	$table = $_POST['table'];
	$column = $_POST['column'];
	$condition_column = $_POST['condition_column'];
	$condition_value = $_POST['condition_value'];
	$condition = "where {$condition_column} like '{$condition_value}'";
	$suffix = $_POST['suffix'];
	$value = $_POST['value'];
	$_POST[$column] = $value;
	$db->query("select {$condition_column} from #_{$table} {$condition}");
	if($db->num_rows() <= 0)
		$db->query("insert into #_{$table} (id, {$condition_column}) values (".$db->getMaxId($table).", '{$condition_value}')");
	if(saveItem(array("table" => $table, "data" => array($column), "condition" => $condition)))
		echo "1";
}
?>