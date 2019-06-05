<?php
$table = "post";
$resourceType = "post";
$row_language = getItems(array("table" => "language", "orderby" => array("`index`")));

$filterStr = $com."_filter";
$filterCondition = getFilter($filterStr, "where");

switch (true) {
	case $act=="list":
		$filter_items = getItems(array("table" => "category", "condition" => "where type like 'post' order by parent_id, `index`"));
		$items = getItems(array("table" => $table, "condition" => "{$filterCondition} order by create_date desc, category_id, title", "limit" => 10, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "post/list";
		break;
	case $act=="edit":
		$row_category = getItems(array("table" => "category", "condition" => "where type like 'post' order by parent_id, `index`"));
		$row_province = getItems(array("table" => "province", "orderby" => array("name not in ('Hồ Chí Minh', 'Hà Nội')", "type", "name")));
		if($_REQUEST['id'] != "") {
			$item=getItems(array("table" => $table, "id" => $_REQUEST['id']));
			if(!is_array($item)) { show_error(); exit(1); }
			$row_translate = array();
			foreach($row_language as $r_language):
				$row_translate[] = getTranslate($table, $r_language['id'], $_REQUEST['id']);
			endforeach;
		}
		$template = "post/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			$data = array("title", "uri", "link", "category_id", "thumbnail", "level", "popular","province" ,"enable");
			if(@$_POST['url'] != "")
				$_POST['thumbnail'] = $_POST['url'];
			if(@$_POST['link'] != "")
				$_POST['link'] = getURL($_POST['link']);
			$_POST["title"] = $_POST["title_{$row_language[0]['uri']}"];
			if($_POST['id']!="")
				$condition = "where id like '{$_POST['id']}'";
			else {
				$maxId = $db->getMaxId($table);
                                $data[] = "create_date";
                        }
			if(!saveItem(array("table" => $table, "data" => $data, "condition" => @$condition))) {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
			foreach($row_language as $r_language):
				$data = array("title", "description", "content", "keyword", "desc", "h1", "h2", "h3");
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