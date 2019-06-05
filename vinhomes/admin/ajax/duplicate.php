<?php
session_start();
@define ( '_template' , '../../templates/');
@define ( '_source' , '../../sources/');
@define ( '_lib' , '../../lib/');
include_once _lib."config.php";
include_once _lib."class.database.php";
// include_once _lib."pagination.php";
include_once _lib."functions.php";
$db = new database($config['database']);
$logged = @$_COOKIE['user']['username'] != "";
if(!$logged) die(0);

$table = $_POST['table'];
$id = $_POST['id'];

$db->setTable($table);
$db->setCondition("where id like '{$id}'");
$db->select();
if($db->num_rows() <= 0) {
	echo 0;
	exit(1);
}
$item = $db->fetch_array();
$item['id'] = $db->getMaxId($table);
if($item['uri'] != "")
	$item['uri'] = checkURI($table, $item);
$result = $db->insert($item);
if(in_array($table, array("category", "product", "product_tab", "post", "module"))):
	$db->setTable("translate");
	$db->setCondition("where item_id like '{$id}' and table_name like '{$table}'");
	$db->select();
	if($db->num_rows() <= 0) {
		echo 1;
		exit(1);
	}
	$items = $db->result_array();
	for ($i=0; $i<count($items); $i++):
		$items[$i]['id'] = $db->getMaxId("translate");
		$items[$i]['item_id'] = $item['id'];
		$db->insert($items[$i]);
	endfor;
endif;
echo 1;
?>