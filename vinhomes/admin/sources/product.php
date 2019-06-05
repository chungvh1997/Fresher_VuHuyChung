<?php
$table = "product";
$resourceType = "product";
$row_language = getItems(array("table" => "language", "orderby" => array("`index`")));

$filterStr = $com."_filter";
$filterStr = getFilter($filterStr, "where");

switch (true) {
	case $act=="list":
		$filter_items = getItems(array("table" => "category", "condition" => "where type like 'product' order by parent_id, `index`"));
		$items = getItems(array("table" => $table, "condition" => "{$filterStr} order by create_date desc, category_id, title", "limit" => 10, "pagination" => true));
		$paging = $pagination->getSource("&p");
		$template = "product/list";
		break;
	case $act=="edit":
		$row_direction = array( "Đông", "Tây", "Nam", "Bắc", "Đông Nam", "Tây Nam", "Đông Bắc", "Tây Bắc" ); // Bỏ
		$row_category = getItems(array("table" => "category", "condition" => "where type like 'product' and enable>0 order by parent_id, `index`"));
		$row_project = getItems(array("table" => "category", "condition" => "where type like 'project' and enable>0 order by parent_id, `index`"));
		// $row_brand = getItems(array("table" => "category", "condition" => "where type like 'brand' and enable>0 order by parent_id, `index`"));
		if($_REQUEST['id'] != "") {
			$item=getItems(array("table" => $table, "id" => $_REQUEST['id']));
			if(!is_array($item)) { show_error(); exit(1); }
			$row_translate = array();
			foreach($row_language as $r_language):
				$row_translate[] = getTranslate($table, $r_language['id'], $_REQUEST['id']);
			endforeach;
		}
		// /* Bỏ
		$row_province = getItems(array("table" => "province", "orderby" => array("name not in ('Hồ Chí Minh', 'Hà Nội')", "type", "name")));
		$row_district = getItems(array("table" => "district", "condition" => "where pid like '{$item['province']}' order by type, name"));
		$row_ward = getItems(array("table" => "ward", "condition" => "where pid like '{$item['district']}' order by type, name"));
		// đến đây */
		$template = "product/edit";
		break;
	case $act=="save":
		if(isset($_POST['savebtn'])) {
			$data = array("title", "uri", "category_id","project_id", "brand_id", "serial", "thumbnail", "level", "popular","province","dientich","phongngu","loaihinh" ,"enable", "create_date");
		
			$_POST['level'] = intval($_POST['level']);
			$_POST['dientich'] = implode(";", $_POST['dientich']);
			$_POST['phongngu'] = implode(";", $_POST['phongngu']);
			$_POST['loaihinh'] = implode(";", $_POST['loaihinh']);

			if(@$_POST['url'] != "")
				$_POST['thumbnail'] = $_POST['url'];
			$_POST["title"] = $_POST["title_{$row_language[0]['uri']}"];
			if($_POST['id']!="") {
				$maxId = $_POST['id'];
				$condition = "where id like '{$_POST['id']}'";
			}
			else
				$maxId = $db->getMaxId($table);
			if(!saveItem(array("table" => $table, "data" => $data, "condition" => @$condition))) {
				alert("Lỗi lưu dữ liệu!");
				back();
			}
			foreach($row_language as $r_language):
				$data = array("title", "price_sale", "price", "description", "content","first_tag","second_tag", "keyword", "desc", "h1", "h2", "h3");
				$_POST["item_id_{$r_language['uri']}"] = $maxId;
				$_POST["language_id_{$r_language['uri']}"] = $r_language['id'];
				$_POST["table_name_{$r_language['uri']}"] = $table;
				$data = array_merge($data, array( "item_id", "language_id", "table_name" ));
				if(@$_POST['id'] != "") {
					$translate = getItems(array("table" => "translate", "id" => 0, "condition" => "where item_id like '{$_POST['id']}' and language_id like '{$r_language['id']}' and table_name like '{$table}'"));
					if(!is_array($translate) || empty($translate))
						$db->query("insert into tbl_translate (id, item_id, language_id, table_name) values (".$db->getMaxId("translate").", {$_POST['id']}, {$r_language['id']}, '{$table}')");
					$condition = "where item_id like '{$_POST['id']}' and language_id like '{$r_language['id']}' and table_name like '{$table}'";
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