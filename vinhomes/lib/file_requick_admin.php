<?php
$com = $_REQUEST['com'];
$act = $_REQUEST['act'];
$db = new database($config['database']);
$user = getUser();

$db->setTable('website');
$db->select();
$information=$db->fetch_array();

$lang = getItems(array("table" => "language", "id" => 0, "condition" => "where enable>0 order by `index`"));
$_SESSION['lang'] = $lang;

if($_COOKIE['user']['username'] != "" || ($com=="user" && $act=="login")) {
	switch(true) {
		case $com == "":
			$source = $template = "index";
			break;
		case file_exists(_source.$com.".php"):
			$source = $com;
			break;
		default:
			alert("Đường dẫn không hợp lệ!");
			redirect(getBaseURL());
	}
}
else{
	redirect("index.php?com=user&act=login");
}

if(!defined('_source')) show_error();
if(@$source != "") include _source.$source.".php";
?>
