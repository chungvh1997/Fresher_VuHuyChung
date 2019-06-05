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

$type = $_POST['type'];
if(in_array($type, array("", "list-view"))) {
	$_SESSION['index_view_type'] = $type;
	echo 1;
}
else
	die(0);
?>