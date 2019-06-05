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
	$data = array("type", "name", "value");
	if($_POST['link'] != "")
		$data[] = "link";
	$condition = "where name like '{$_POST['name']}'";
	$db->query("select id from #_layout {$condition}");
	if($db->num_rows() <= 0)
		$db->query("insert into #_layout (id, name) values (".$db->getMaxId("layout").", '{$_POST['name']}')");
	if(saveItem(array("table" => "layout", "data" => $data, "condition" => $condition)))
		echo "1";
}
?>