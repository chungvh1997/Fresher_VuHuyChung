<?php
$table = "category_image";
$resourceType = "category";
$item = getItems(array("table" => "category", "id" => $_REQUEST['category_id']));

if(is_array(@$item)) {
	$category = @$item;
	unset($item);
}
else
	show_error();

switch (true) {
	case $act=="list":
		$items = getItems(array("table" => $table, "condition" => "where category_id like '{$category['id']}'", "limit" => 10, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "category-image/list";
		break;
	case $act=="edit":
		if($_REQUEST['id'] != "")
			$item = getItems(array("table" => $table, "id" => $_REQUEST['id']));
		$template = "category-image/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			if(@$_POST['url'] != "")
				$_POST['thumbnail'] = $_POST['url'];
			$data = array("category_id", "thumbnail", "enable", "index");
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