<?php
$table = "module";
$row_language = getItems(array("table" => "language", "orderby" => array("`index`")));

switch (true) {
	case $act=="list":
		$items = getItems(array("table" => $table, "limit" => 20, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "module/list";
		break;
	case $act=="edit":
		if($_REQUEST['id'] != "") {
			$item=getItems(array("table" => $table, "id" => $_REQUEST['id']));
			if(!is_array($item)) { show_error(); exit(1); }
			$row_translate = array();
			foreach($row_language as $r_language):
				$row_translate[] = getTranslate($table, $r_language['id'], $_REQUEST['id']);
			endforeach;
		}
		$template = "module/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			$data = array("title", "enable");
			$_POST["title"] = $_POST["title_{$row_language[0]['uri']}"];
			if($_POST['id']!="")
				$condition = "where id like '{$_POST['id']}'";
			else
				$maxId = $db->getMaxId($table);
			if(!saveItem(array("table" => $table, "data" => $data, "condition" => @$condition))) {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
			foreach($row_language as $r_language):
				$data = array("title");
				if(@$_POST['id'] != "") {
					$translate = getItems(array("table" => "translate", "id" => 0, "condition" => "where item_id like '{$_POST['id']}' and language_id like '{$r_language['id']}' and table_name like '{$table}'"));
					if(!is_array($translate) || empty($translate))
						$db->query("insert into tbl_translate (id, item_id, language_id, table_name) values (".$db->getMaxId("translate").", {$_POST['id']}, {$r_language['id']}, '{$table}')");
					$condition = "where item_id like '{$_POST['id']}' and language_id like '{$r_language['id']}' and table_name like '{$table}'";
				}
				else {
					$data = array_merge($data, array( "item_id", "language_id", "table_name" ));
					$_POST["item_id_{$r_language['uri']}"] = $maxId;
					$_POST["language_id_{$r_language['uri']}"] = $r_language['id'];
					$_POST["table_name_{$r_language['uri']}"] = $table;
				}
				if(!saveItem(array("table" => "translate", "data" => $data, "condition" => @$condition, "affix" => $r_language['uri']))) {
					alert("Lỗi lưu dữ liệu!");
					back();
				}
			endforeach;
			redirect( preg_replace('/(&id=\d*)/', '', str_replace("&act=save", "&act=list", getCurrentPageURL())) );
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