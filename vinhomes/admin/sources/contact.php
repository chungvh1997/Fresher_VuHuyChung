<?php
$table = "contact";

switch (true) {
	case $act=="list":
		$items = getItems(array("table" => $table, "orderby" => array("create_date desc", "email"), "limit" => 20, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "contact/list";
		break;
	case $act=="view":
		if($_REQUEST['id'] != "")
			$item = getItems(array("table" => $table, "id" => $_REQUEST['id']));
		$template = "contact/view";
		break;
	// case $act=="save":
	// 	if(isset($_POST['savebtn'])) {
	// 		$data = array("hoten", "diachi", "dienthoai", "email", "giaban", "noidung", "ngaygui");
	// 		if(@$_POST['id'] != "")
	// 			$condition = "where id like '{$_POST['id']}'";
	// 		if(saveItem(array("table" => $table, "data" => $data, "condition" => @$condition)))
	// 			redirect( preg_replace('/(&id=\d*)/', '', str_replace("&act=save", "&act=list", getCurrentPageURL())) );
	// 		else {
	// 			alert("Lỗi lưu dữ liệu!");
	// 			back();
	// 		}
	// 	}
	// 	else {
	// 		alert("Không nhận được dữ liệu!");
	// 		back();
	// 	}
	// 	break;
	default:
		show_error();
		break;
}
?>