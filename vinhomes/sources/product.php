<?php
switch (true) {
	case is_array($category) && $category['type']=="product":
		// $keyword = $_SESSION['search']['title'];
		// if($keyword != "")
		// 	$category['title'] .= " theo từ khóa '{$keyword}'";
		// $items = getItems("category", "where id like '{$category['id']}' order by `index`, title", false);
		// $cat_title_list = array();
		// $cat_title_list['category'] = array();
		// foreach ($items as $k => $item)
		// 	$cat_title_list['category'][] = strtolower($item['title']);
		// $cat_title_list['category'] = implode(", ", $cat_title_list['category']);
		// $cat_title_list['category'][0] = strtoupper($cat_title_list['category'][0]);
		// $title = implode(" ", $cat_title_list);

		$cat_id_list = array();
		$cat_id_list[] = $category['id'];
		do {
			$row_sub_cat = getItems(array("table" => "category", "condition" => "where type like 'product' and parent_id in (".implode(",", $cat_id_list).") and id not in (".implode(",", $cat_id_list).") and enable>0"));
			foreach ($row_sub_cat as $r_sub_cat)
				$cat_id_list[] = $r_sub_cat['id'];
		} while(is_array($row_sub_cat) && !empty($row_sub_cat));
		$cat_id_list = implode(", ", $cat_id_list);

		// $priceStr = $_SESSION['filter']['price'];
		// if(@$priceStr == "")
		// 	$priceStr = "true";
		// else {
		// 	$priceStr = explode("-", $priceStr);
		// 	if(!in_array(@$priceStr[0], array("", "min")))
		// 		$priceStr[0] = "t.price>={$priceStr[0]}";
		// 	if(!in_array(@$priceStr[1], array("", "max")))
		// 		$priceStr[1] = "t.price<={$priceStr[1]}";
		// 	$priceStr = str_replace("min", "true", str_replace("max", "true", implode(" and ", $priceStr)));
		// }

		// $filterStr = "";
		// if($_SESSION['filter']['keyword']!="")
		// 	$filterStr = "(t.title like '%{$_SESSION['filter']['keyword']}%' or '{$_SESSION['filter']['keyword']}' like '%' && t.title && '%') and ";
		// $filterStr .= $priceStr . " and";
		
		$limit = 12;
		$step = 12;

		// $db->query("select p.*, t.*, p.id from #_product p join #_translate t on p.id=t.item_id where t.language_id like '{$lang['id']}' and t.table_name like 'product' and ( category_id in ({$cat_id_list}) or brand_id in ({$cat_id_list}) ) and {$filterStr} enable>0 ".($keyword!="" ? "and p.title like '%{$keyword}%'" : "")." order by p.view, p.create_date desc, p.level, t.title");
		$row_product = getItems(array("table" => "product", "condition" => "where category_id in ({$cat_id_list}) order by level desc, create_date desc, title"));
		
		$num_product = count($row_product);

		$row_product = array_slice($row_product, 0, $limit);
		// $row_product = $pagination->paging($row_product, $limit, $_REQUEST['p']);
		// $paging = $pagination->getSource();
		
		$row_breadcrumb = array($category['uri'] => $category['title']);
		$id_list = array($category['parent_id']);
		$not_list = array($category['id']);
		do {
			$row_category = getItems(array("table" => "category", "condition" => "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")"));
			foreach ($row_category as $r_category) {
				if(intval($r_category['parent_id']) > 0) {
					$id_list[] = $r_category['parent_id'];
				}
				$row_breadcrumb[$r_category['uri']] = $r_category['title'];
				$not_list[] = $r_category['id'];
			}
		} while (is_array($row_category) && !empty($row_category));
		$row_breadcrumb = array_reverse($row_breadcrumb);

		$template = "product";
		break;

	case is_array($product):
		$view_list = explode(",", @$_SESSION['viewlist']);
		if(!in_array($product['id'], $view_list)) {
			$db->query("update #_product set view=view+1 where id like '{$product['id']}'");
			if($view_list[0]=="")
				$view_list = array();
			$view_list[] = $product['id'];
		}
		$_SESSION['viewlist'] = implode(",", $view_list);

		$image_items = getItems(array("table" => "product_image", "condition" => "where product_id like '{$product['id']}' order by `index`"));
		$row_slide = array(array( "thumbnail" => $product['thumbnail'] ));
		$image_alt = $product['title'];
		foreach ($image_items as $value)
			$row_slide[] = array( "thumbnail" => $value['thumbnail'] );

		$row_tab = getItems(array("table" => "product_tab", "condition" => "where product_id like '{$product['id']}' order by `index`, title"));
		
		$limit = 8;
		$step = 8;

		$row_related = getItems(array("table" => "product", "condition" => "where category_id like '{$product['category_id']}' and enable>0 and id not like '{$product['id']}' order by popular desc, level desc, create_date desc, title", "limit" => $limit));
		$num_product = count($row_related);
		// $row_related = $pagination->paging($row_related, $limit, $_REQUEST['p']);

		$row_relative_view = getItems(array("table" => "product", "condition" => "where enable>0 and id in (".implode(",", $view_list).") order by `view` desc, popular desc, level desc, create_date desc, title", "limit" => 4));

		$row_breadcrumb = array($product['uri'] => $product['title']);
		$id_list = array($product['category_id']);
		$not_list = array("''");
		do {
			$row_category = getItems(array("table" => "category", "condition" => "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")"));
			foreach ($row_category as $r_category) {
				if(intval($r_category['parent_id']) > 0) {
					$id_list[] = $r_category['parent_id'];
				}
				$row_breadcrumb[$r_category['uri']] = $r_category['title'];
				$not_list[] = $r_category['id'];
			}
		} while (is_array($row_category) && !empty($row_category));
		$row_breadcrumb = array_reverse($row_breadcrumb);

		$template = "product_detail";
		break;

	default:
		show_error();
		break;
}
?>