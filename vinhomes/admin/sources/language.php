<?php
$table = "language";
$resourceType = "image";

$trans_array = array(
	"column_1" => "column_1", 
	"column_2" => "column_2", 
	"column_3" => "column_3", 
	"column_4" => "column_4", 
	"column_5" => "column_5", 
	"column_6" => "column_6", 
	"column_7" => "column_7", 
	"column_8" => "column_8", 
	"column_9" => "column_9", 
	"column_10" => "column_10", 
	"column_11" => "column_11", 
	"column_12" => "column_12", 
	"column_14" => "column_14", 
	"column_15" => "column_15", 
	"column_16" => "column_16", 
	"column_17" => "column_17", 
	"column_18" => "column_18", 
	"column_19" => "column_19", 
	"column_20" => "column_20", 
	"column_21" => "column_21", 
	"column_22" => "column_22",  
	"column_23" => "column_23", 
	"column_24" => "column_24", 
	"column_25" => "column_25", 
	"column_26" => "column_26", 
	"column_27" => "column_27", 
	"column_28" => "column_28", 
	"column_29" => "column_29", 
	"column_30" => "column_30", 
);

switch (true) {
	case $act=="list":
		$items = getItems(array("table" => $table, "orderby" => array("`index`"), "limit" => 10, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "language/list";
		break;
	case $act=="edit":
		if($_REQUEST['id'] != "") {
			$item = getItems(array("table" => $table, "id" => $_REQUEST['id']));
			foreach (array_keys($trans_array) as $key) {
				if(trim($item[$key]) != "")
					$trans_array[$key] = mb_strtoupper(mb_substr($item[$key], 0, 1, "UTF-8"), "UTF-8").mb_substr(mb_strtolower($item[$key], "UTF-8"), 1, mb_strlen($item[$key], "UTF-8"), "UTF-8").(count(explode("(", $trans_array[$key]))>1?" (".end(explode("(", $trans_array[$key])):"");
			}
			if(!is_array(@$item)) show_error();
		}
		$template = "language/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			if(@$_POST['url'] != "")
				$_POST['thumbnail'] = $_POST['url'];
			$data = array_merge(array("title", "uri", "thumbnail", "index", "enable"), array_keys($trans_array));
			if(@$_POST['id'] != "")
				$condition = "where id like '{$_POST['id']}'";
			if(saveItem(array("table" => $table, "data" => $data, "condition" => @$condition)))
				redirect( preg_replace('/(&id=\d*)/', '', str_replace("&act=save", "&act=list", getCurrentPageURL())) );
			else {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
		}
		else {
			alert("Không nhận được dữ liệu!");
			back();
		}
		break;
	default:
		show_error();
		break;
}
?>