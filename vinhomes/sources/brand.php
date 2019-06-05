<?php
switch (true) {
	case is_array($category) && $category['type']=="brand":
		$cat_id_list = array();
		$cat_id_list[] = $category['id'];
		do {
			$row_sub_cat = getItems("category", "where type like '{$category['type']}' and parent_id in (".implode(",", $cat_id_list).") and id not in (".implode(",", $cat_id_list).") and enable>0", false);
			foreach ($row_sub_cat as $r_sub_cat)
				$cat_id_list[] = $r_sub_cat['id'];
		} while(is_array($row_sub_cat) && !empty($row_sub_cat));
		$cat_id_list = implode(", ", $cat_id_list);
		
		$limit = 12;
		$step = 12;

		$row_product = getItems("product", "where brand_id in ({$cat_id_list}) order by level desc, create_date desc, title", false);
		
		$num_product = count($row_product);

		$row_product = $pagination->paging($row_product, $limit, $_REQUEST['p']);
		$paging = $pagination->getSource();
		
		$row_breadcrumb = array($category['uri'] => $category['title']);
		$id_list = array($category['parent_id']);
		$not_list = array($category['id']);
		do {
			$row_category = getItems("category", "where id in (".implode(",", $id_list).") and id not in (".implode(",", $not_list).")", false);
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

	default:
		show_error();
		break;
}
?>